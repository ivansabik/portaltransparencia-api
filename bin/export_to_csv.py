import glob
import json

import pandas as pd


def main():
    raw_data_list = []
    files = glob.glob("/Users/britecorio/portal-transparencia/contracts/parsed/*.json")
    for file_path in files:
        print(f"Appending {file_path}")
        with open(file_path) as json_file:
            raw_data = json.load(json_file)
            raw_data_list.append(raw_data)
    df = pd.DataFrame(raw_data_list)

    # Remove non numeric chars from numeric cols
    for col in [
        "montocontrato",
        "montosinimpuestos",
        "montoconimpuestos",
        "montominimo",
        "montomaximo",
    ]:
        df[col] = df[col].str.replace("$", "")
        df[col] = df[col].str.replace(",", "")
        df[col] = pd.to_numeric(df[col])

    # Fix wrong URLs
    for col in ["hipervinculodocumento", "hipervinculoampliacion"]:
        df[col] = df[col].str.replace("htIN-RELEVtp", "http")

    # Split these single date ranges into two columns
    df[["periodoreportainicio", "periodoreportafin"]] = df["periodoreporta"].str.split(
        " - ",
        expand=True,
    )
    del df["periodoreporta"]
    df[["periodoinformainicio", "periodoinformafin"]] = df["periodoinforma"].str.split(
        " - ",
        expand=True,
    )

    df.to_csv(
        "/Users/britecorio/portal-transparencia/contracts/contracts.csv",
        index=False,
        encoding="utf-8-sig",
    )
    del df["periodoinforma"]


if __name__ == "__main__":
    main()
