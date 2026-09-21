
import pandas as pd
import numpy as np

def clean_data(df):
    df[df["Postal Code"].isna()][["City", "Postal Code"]]
    df["City"] = df["City"].str.strip().str.lower()
    # df.groupby("City")["Postal Code"].describe()
    # counts = df.groupby("City")["Postal Code"].nunique()
    # counts[counts == 0]
    df[df["Postal Code"].isna()][["City", "Postal Code"]]
    def postal_replace(city):
        most_postal = df[(df["City"]==city)].groupby("Postal Code")["City"].agg(lambda x: x.mode()[0])
        # df[df["City"] == city].groupby("Postal Code")["City"].value_counts()
        df.loc[df["City"] == city, "Postal Code"] = most_postal.index[0]

    cites = df["City"].unique()
    for city in cites:
        postal_replace(city)

    df[df["Quantity"].isna()][["Quantity", "Sales", "Ship Date", "Product Name", "Ship Mode", "Order ID"]]
    df = df.dropna(subset=['Quantity', 'Sales'], how ='all')
    df[df["Quantity"].isna()][["Quantity", "Sales", "Ship Date", "Product Name", "Ship Mode", "Order ID"]]

    df[df["Quantity"].isna() & df["Sales"].isna()][["Quantity", "Sales", "Ship Date", "Product Name", "Ship Mode", "Order ID"]]
    df = df.dropna(subset=["Quantity", "Sales"], how="all")

    df["Product_general_price"] = (df["Sales"]/df["Quantity"])*(1-df["Discount"])
    df["Quantity"] = (df["Sales"]/df["Product_general_price"])
    df["Product_general_price"] = (df["Sales"]/df["Quantity"])*(1-df["Discount"])
    outliers = df.groupby("Product ID")["Product_general_price"].agg(
        Q1 = lambda sale: sale.quantile(0.25),
        Q3 = lambda sale: sale.quantile(0.75),
        Moyen="mean"
    )
    outliers["IQR"] = outliers["Q3"] - outliers["Q1"]
    outliers["borne_inf"] = (outliers["Q1"] - 1.5 * outliers["IQR"])
    outliers["borne_sup"] = (outliers["Q3"] + 1.5 * outliers["IQR"])
    df["is_outlier"] = ((df["Product_general_price"] < df["Product ID"].map(outliers["borne_inf"]))|(df["Product_general_price"] > df["Product ID"].map(outliers["borne_sup"])))
    product_mean = (df.loc[~df["is_outlier"]].groupby("Product ID")["Product_general_price"].mean())
    df["Product_median_price"] = df["Product ID"].map(product_mean)
    df.loc[df["Quantity"].isna(), "Quantity"] = (df.loc[df["Quantity"].isna(), "Sales"] * (1 - df.loc[df["Quantity"].isna(), "Discount"]) / df.loc[df["Quantity"].isna(), "Product_median_price"])
    df.loc[df["Quantity"]<0, "Quantity"] = (df.loc[df["Quantity"]<0, "Sales"] * (1 - df.loc[df["Quantity"]<0, "Discount"]) / df.loc[df["Quantity"]<0, "Product_median_price"])
    df = df.dropna(subset=["Product_median_price"])
    df[df["Quantity"].isna()]

    df.isna().sum()
    df.drop(df[df["Quantity"] < 0].index, inplace=True)
    df[df["Quantity"]<0]

    df["Product Name"] = df["Product Name"].str.title()
    p = df.groupby("Product Name")["Product ID"].nunique()
    p[p>1]

    name_id_count = df.groupby(["Product Name", "Product ID"]).size().reset_index(name="Count")

    name_id_count

    product_names = df.groupby("Product Name")["Product ID"].nunique()
    product_names = product_names[product_names > 1].index
    product_names
    result = name_id_count[name_id_count["Product Name"].isin(product_names)]
    result

    mode_id = df.groupby("Product Name")["Product ID"].agg(lambda x: x.mode()[0])
    df["Product ID"] = df["Product Name"].map(mode_id)


    df["Order Date"] = pd.to_datetime(df["Order Date"], format="mixed")
    df["Ship Date"] = pd.to_datetime(df["Ship Date"], format="mixed")
    df["Shipping_Days"] = (df["Ship Date"] - df["Order Date"]).dt.days
    df[df["Ship Date"].isna()][["Order Date","Ship Date", "Ship Mode", "Shipping_Days"]]
    df.drop(df[df["Shipping_Days"]<0].index, inplace=True)

    shipping_statiss = df.groupby("Ship Mode")["Shipping_Days"].agg(
        Median="median",
        Mean="mean",
        Min="min",
        Max="max",
        Count="count"
    )
    df[["Order Date","Ship Date", "Ship Mode", "Shipping_Days"]]
    df.drop(df[df["Shipping_Days"] < 0].index, inplace=True)
    df[df["Shipping_Days"]<0]
    # print(shipping_statiss)
    df.groupby("Shipping_Days")["Ship Mode"].value_counts()
    pd.crosstab(df["Shipping_Days"],df["Ship Mode"])
    grouped = df.groupby("Shipping_Days")["Ship Mode"].agg(
        frequency = lambda x: x.mode()[0]
    )
    grouped.squeeze()
    df["Ship Mode"] = df["Ship Mode"].fillna(df["Shipping_Days"].map(grouped.squeeze()))
    df[["Order Date","Ship Date", "Ship Mode", "Shipping_Days"]]


    df.isna().sum()
    df[df["Ship Mode"].isna()][["Order Date","Ship Date", "Ship Mode", "Shipping_Days"]]
    df.drop(df[df["Ship Mode"].isna()].index, inplace=True)
    df.isna().sum()

    # df[df["Ship Date"].isna()][["Order Date","Ship Date", "Ship Mode"]]


    df.drop(df[df["Ship Mode"].isna()].index, inplace=True)

    df["Order Date"] = pd.to_datetime(df["Order Date"], format="mixed")
    df["Ship Date"] = pd.to_datetime(df["Ship Date"], format="mixed")
    df["Shipping_Days"] = (df["Ship Date"] - df["Order Date"]).dt.days
    shipping_statiss = df.groupby("Ship Mode")["Shipping_Days"].agg(
        Median="median",
        Mean="mean",
        Min="min",
        Max="max",
        Count="count"
    )
    df[["Order Date","Ship Date", "Ship Mode", "Shipping_Days"]]
    df.drop(df[df["Shipping_Days"] < 0].index, inplace=True)
    df[df["Shipping_Days"]<0]
    # print(shipping_statiss)
    df.groupby("Shipping_Days")["Ship Mode"].value_counts()
    pd.crosstab(df["Shipping_Days"],df["Ship Mode"])
    grouped = df.groupby("Ship Mode")["Shipping_Days"].agg(
        frequency = lambda x: x.mode()[0]
    )
    grouped
    df["Shipping_Days"] = df["Shipping_Days"].fillna(df["Ship Mode"].map(grouped.squeeze()))
    df[df["Shipping_Days"].isna()]

    df["Order Date"] = pd.to_datetime(df["Order Date"], format="mixed")
    df["Ship Date"] = pd.to_datetime(df["Ship Date"], format="mixed")
    df.loc[df["Ship Date"].isna(), "Ship Date"] = df.loc[df["Ship Date"].isna(),"Order Date"] + pd.to_timedelta(df.loc[df["Ship Date"].isna(),"Shipping_Days"], unit="D")
    df[df["Ship Date"].isna()][["Order Date","Ship Date", "Ship Mode", "Shipping_Days"]]

    df.isna().sum()
    df[df["Customer Name"].isna()][["Product Name", "Order ID"]]
    cus = df.groupby("Order ID")["Customer Name"].agg(
        freq = lambda x: x.mode()
    )

    miss = df.groupby("Order ID")["Customer Name"].apply(lambda x: x.isna().all())
    misss = miss[miss==True].index
    df.drop(df[df["Order ID"].isin(misss)].index, inplace=True)
    # data frame indexes
    miss[miss==True]
    cus
    df["Customer Name"] = df["Customer Name"].fillna(df["Order ID"].map(cus.squeeze()))
    df[df["Customer Name"].isna()][["Product Name", "Order ID"]]


    df.isna().sum()
    df[df["Sales"].isna()& df["Quantity"].isna()][["Quantity", "Sales", "Ship Date", "Product Name", "Ship Mode", "Order ID"]]
    df = df.dropna(subset=['Quantity', 'Sales'], how ='all')
    df[df["Sales"].isna()][["Quantity", "Sales", "Ship Date", "Product Name", "Ship Mode", "Order ID"]]

    df["Product_general_price"] = (df["Sales"]/df["Quantity"])*(1-df["Discount"])

    outliers = df.groupby("Product ID")["Product_general_price"].agg(
        Q1 = lambda sale: sale.quantile(0.25),
        Q3 = lambda sale: sale.quantile(0.75),
        Moyen="mean"
    )
    outliers
    outliers["IQR"] = outliers["Q3"] - outliers["Q1"]
    outliers["borne_inf"] = (outliers["Q1"] - 1.5 * outliers["IQR"])
    outliers["borne_sup"] = (outliers["Q3"] + 1.5 * outliers["IQR"])
    df["is_outlier"] = ((df["Product_general_price"] < df["Product ID"].map(outliers["borne_inf"]))|(df["Product_general_price"] > df["Product ID"].map(outliers["borne_sup"])))
    product_mean = (df.loc[~df["is_outlier"]].groupby("Product ID")["Product_general_price"].mean())
    product_mean
    df["Product_median_price"] = df["Product ID"].map(product_mean)
    df.loc[df["Sales"].isna(), "Sales"] = (df.loc[df["Sales"].isna(), "Quantity"] * (1 - df.loc[df["Sales"].isna(), "Discount"]) * df.loc[df["Sales"].isna(), "Product_median_price"])
    df = df.dropna(subset=["Product_median_price"])
    df[df["Sales"].isna()]


    df = df.drop_duplicates()
    df.duplicated().sum()

    
    df["Segment"].unique()

    df["Segment"] = df["Segment"].replace({
        "Consumerr": "Consumer",
        "Corporrate": "Corporate",
        "Home Ofice": "Home Office"
    })
    df["Segment"].unique()

    df["Category"] = df["Category"].str.title()
    df["State"] = df["State"].str.title()
    df["Category"].unique()
    # df["State"].nunique()

    df.loc[df["is_outlier"]==True, "Sales"] = (df.loc[df["is_outlier"]==True, "Quantity"] * (1 - df.loc[df["is_outlier"]==True, "Discount"]) * df.loc[df["Sales"].isna(), "Product_median_price"])
    df[df["is_outlier"]==True]

    df["profit_margin"] = np.where(df["Sales"] != 0, df["Profit"] / df["Sales"], np.nan)
    return df