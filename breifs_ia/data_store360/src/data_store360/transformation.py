import os
import hashlib
from dotenv import load_dotenv
import pandas as pd

def hash_cus(df):
    load_dotenv()
    salt = os.getenv("SECRET_SALT")
    if not salt:
        raise ValueError("SECRET_SALT is missing")

    salt_cle = salt.encode("utf-8")
    columns = ["Customer ID","Customer Name","City","State","Postal Code","Country","Region"]

    customer_data = (df[columns].fillna("Inconnue").astype(str).agg("|".join, axis=1))
    def pseudonymize(value):
        normalized = str(value).strip().lower().encode("utf-8")
        return hashlib.sha256(normalized + salt_cle).hexdigest()
    return customer_data.map(pseudonymize)