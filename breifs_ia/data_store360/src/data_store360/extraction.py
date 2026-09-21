import pandas as pd
csv_path = "/opt/airflow/data/raw/store_data.csv"
def extract_csv():
    return pd.read_csv(csv_path)
