from pathlib import Path
from datetime import datetime
import json

import scrapy


class SalariesSpider(scrapy.Spider):
    name = "salaries"

    def start_requests(self):
        url = "https://tematicos.plataformadetransparencia.org.mx/web/guest/informacionrelevante?p_p_id=informacionrelevante_WAR_Informacionrelevante&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=buscarContrataciones&p_p_cacheability=cacheLevelPage&_informacionrelevante_WAR_Informacionrelevante_controller=ContratosController"
        data = {
            "contenido": " ",
            "coleccion": "sueldos",
            "jsonAtributos": "",
            "dePaginador": False,
            "numeroPagina": 0,
            "filtroSeleccionado": "",
            "atributosSeleccionados": "",
            "cantidad": "200",
            "tipoOrdenamiento": 2,
        }
        for page_num in range(0, 329937):
            request_data = data.copy()
            request_data["numeroPagina"] = page_num
            yield scrapy.Request(
                url=url,
                method="POST",
                body=json.dumps(request_data),
                callback=self.parse,
                meta={"page_num": page_num},
            )

    def parse(self, response):
        page_num = response.meta["page_num"]
        parse_date = datetime.today().strftime("%Y-%m-%d")
        filename = f"/Users/britecorio/portal-transparencia/salaries/raw/{parse_date}-{page_num}.json"
        Path("/Users/britecorio/portal-transparencia/salaries/raw/").mkdir(
            parents=True, exist_ok=True
        )
        with open(filename, "wb") as f:
            f.write(response.body)
        self.log(f"Saved file {filename}")

        results = response.json()
        results = results["resultado"]["informacion"]
        Path("/Users/britecorio/portal-transparencia/salaries/parsed/").mkdir(
            parents=True, exist_ok=True
        )
        for result in results:
            main_info = json.loads(result["informacionPrincipal"])
            extended_info = json.loads(result["informacionSecundaria"])
            extended_info = extended_info[0]["informacionPrincipal"][0]
            salary = {**main_info, **extended_info}
            id = result["idInformacion"]
            salary["idInformacion"] = id
            filename = (
                f"/Users/britecorio/portal-transparencia/salaries/parsed/{id}.json"
            )
            self.log(salary)
            with open(filename, "w") as f:
                json.dump(salary, f)
            self.log(f"Saved file {filename}")
