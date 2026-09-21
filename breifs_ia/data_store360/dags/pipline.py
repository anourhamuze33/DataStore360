from datetime import datetime
import pandas as pd
from airflow.decorators import dag, task
from airflow.providers.postgres.hooks.postgres import PostgresHook
from io import StringIO
from src.data_store360.extraction import extract_csv
from src.data_store360.cleaning import clean_data
from src.data_store360.transformation import hash_cus

POSTGRES_CONN_ID = "postgres_datastore"

@dag(dag_id="pipeline", start_date=datetime(2026, 9, 20), schedule=None,catchup=False,)
def pipeline():
    @task
    def extract():
        df = extract_csv()
        return df.to_json(orient="records", date_format="iso")
    @task

    def load_staging(data):
        df = pd.read_json(data)

        hook = PostgresHook(postgres_conn_id=POSTGRES_CONN_ID)
        engine = hook.get_sqlalchemy_engine()

        df.to_sql("superstore_raw", engine, schema="staging", if_exists="replace", index=False,)
    @task

    def transform():
        hook = PostgresHook(postgres_conn_id=POSTGRES_CONN_ID)
        engine = hook.get_sqlalchemy_engine()

        df = pd.read_sql("""SELECT * FROM staging.superstore_raw""", engine,)
        df = clean_data(df)
        df['customer_name_hash'] = hash_cus(df)
        return df.to_json(orient="records", date_format="iso")
    @task

    def load_core(data):
        df = pd.read_json(StringIO(data))

        hook = PostgresHook(postgres_conn_id=POSTGRES_CONN_ID)
        engine = hook.get_sqlalchemy_engine()

        with engine.begin() as connection:
            connection.exec_driver_sql("""TRUNCATE TABLE core.orders, core.products, core.customers CASCADE;""")
            customers = (
                df[[ "Customer ID", "customer_name_hash", "Segment", "Country", "City", "State", "Postal Code", "Region",]]
                .drop_duplicates(subset=["Customer ID"])
                .rename(columns={"Customer ID": "customer_id","customer_name_hash": "customer_name","Segment": "segment","Country": "country","City": "city","State": "state","Postal Code": "postal_code","Region": "region",})
            )
            customers.to_sql(
                "customers",
                connection,
                schema="core",
                if_exists="append",
                index=False,
            )

            products = (
                df[["Product ID","Category","Sub-Category","Product Name",]]
                .drop_duplicates(subset=["Product ID"])
                .rename(columns={"Product ID": "product_id","Category": "category","Sub-Category": "sub_category","Product Name": "product_name",})
            )

            products.to_sql(
                "products",
                connection,
                schema="core",
                if_exists="append",
                index=False,
            )

            orders = df[["Row ID","Order ID","Customer ID","Product ID","Order Date","Ship Date","Ship Mode","Sales","Quantity","Discount","Profit",] ].copy()
            orders = orders.drop_duplicates(subset=["Row ID"], keep="first")

            orders["delivery_time"] = (pd.to_datetime(orders["Ship Date"]) - pd.to_datetime(orders["Order Date"])).dt.days

            orders["profit_margin"] = (orders["Profit"] / orders["Sales"]).fillna(0)
            orders = orders.rename(columns={"Row ID": "row_id","Order ID": "order_id","Customer ID": "customer_id","Product ID": "product_id","Order Date": "order_date","Ship Date": "ship_date","Ship Mode": "ship_mode","Sales": "sales","Quantity": "quantity","Discount": "discount","Profit": "profit",})

            orders.to_sql(
                "orders",
                connection,
                schema="core",
                if_exists="append",
                index=False,
            )

    extracted = extract()
    staging = load_staging(extracted)
    transformed = transform()
    core = load_core(transformed)
    extracted >> staging >> transformed >> core
    
pipeline()