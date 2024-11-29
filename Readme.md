1. # Estructura de la documentación
    1. ## Estructura de los códigos
        - La estructura de los codigos sigue esta idea: **AA.BB**
        - La idea es usar el código AA según:

            | AA code  | Uso sugerido   | Idea |
            |:------|:---------------|:-------------|
            | 00    | Administracion | Documentos relativos a administracion, como contratos de personal, tickets de pago, reglas de desplazamientos, comidas, USD de booking, etc. |
            | 01 | Documentos | Meter en este código todos los documentos |
            | 02 | DayToDay Work | Usar este código para mantener los documentos que se usan día a día |
            |10|BootStrap|Intentar usar este código para los documentos de incializacion del proyecto, en particular el **El Acta de Inicio**|
            |20|Crono|Cronograma, Roadmap y cuando hueviche mas se necesita para intentar saver en que etapa/tarea estamos, cuanto falta en tiempo, en que se ha usado ese tiempo, USD usados y en qué, USD que quedan|
            |30|Requerimientos|Mantener aquí todo lo relativo a lo que se quiere hacer en el proyecto, las ideas generales, pre-ideas, objetivos, tambien los requerimientos ya procesados. Algunos de estos requerimientos se usan o se usaron para el acta de inicio y otros se documentan o se deben documentar para ser implementados, éstos últimos es bueno que tengan un código para su seguimiento. También aquí la matriz de seguimientos|
            |40|Descripción Funcional|Descripción formal de como queremos que funcione el producto o servicio a implementar. Tiene la forma de un manual de usuario.|
            |50|Implementacion|Documentos que se usan en la implementación, tanto en pruebas como en test como en producción|
            |60|Testing|Documentación de pruebas previas al paso a producción|
            |70|GoLie|Cómo se pasa a producción y medición del período de marcha blanca, resultados|
        - El código **BB** se usa como un desglose del código AA.
        - 
1. # Documentación actual
    Monday 18 of November 2024
    ```
        ├── Arquitectura_v.1.0.drawio
        ├── Pelusa-Docs-main.zip
        ├── prompt_assistant.md
        ├── Readme.html
        ├── Readme.md
        ├── 00.00.Administracion
        │   └── 00.20.Finances.xlsx
        ├── 00.20.Finanzas
        │   ├── En proceso
        │   │   └── SiteGround Invoice 3306810.pdf
        │   └── Procesadas
        │       └── readme.md
        ├── 00.30 Keys
        │   └── keys.BORRAME
        ├── 00.30.Keys
        │   └── dummy_private_key.pk
        ├── 01.00.DocumentosVarios
        │   ├── Arquitecturas_tipos.jpg
        │   └── Enfoque_tradiciona_microservicios_de_aplicaciones.webp
        ├── 01.00.GuiasPMBOK
        │   ├── PMBOK_7Ed.pdf
        │   ├── PMBOK_Septima_Edicion_PMI.pdf
        │   └── PMBOX_Guia_del_PMBOK_sexta_edicion_espanol.pdf
        ├── 01.00.PlantillasMD
        │   ├── markdown-cheat-sheet.md
        │   └── markdown_latex-1.md
        ├── 01.10.Index
        │   └── Index Trading_.xlsx
        ├── 01.10.Trading.PineScript
        │   └── Estrategia Estocastico.drawio
        ├── 01.10.Trading.Teoria
        │   ├── Introduccion
        │   │   └── Trading.drawio
        │   ├── Resumenes
        │   │   ├── anatomia-burbuja.jpg
        │   │   ├── esquemaburbuja.png
        │   │   ├── Leccion Dos_Tendencias (1).png
        │   │   ├── ONDAS-DE-ELLIOTT-ZIG-ZAG-PLANAS-y-algo-mas.pdf
        │   │   ├── Patrones de cambios de tendencia.pdf
        │   │   └── Resumen Teoria de Dow.docx
        │   └── Trading Books
        │       ├── A. Utiles
        │       │   ├── La-teoría-de-Dow-Cómo-ganar-en-la-bolsa-de-manera-consistente-_Spanish-Edition_-by-ramon-a-c-flores-.docx
        │       │   ├── La-teoría-de-Dow-Cómo-ganar-en-la-bolsa-de-manera-consistente-_Spanish-Edition_-by-ramon-a-c-flores-.pdf
        │       │   ├── Las ondas de Elliott by Matías Menéndez Larre (z-lib.org).pdf
        │       │   └── Wyckoff-Method-Wyckoff-Analytics-English.pdf
        │       ├── B. Sin mirar
        │       │   └── Tesina-Fractales-en-los-mercados-financieros.pdf
        │       ├── C. For Python
        │       │   └── Manual Velas Japonesas.pdf
        │       ├── X. Legacy
        │       │   ├── CONVIERTETE+EN+UN+INVERSOR+GANADOR+-+LIBRO.pdf
        │       │   └── Hit  Run Trading The Short-Term Stock Traders Bible by Jeff Cooper (z-lib.org).pdf
        │       └── Z. Buffffff
        │           ├── Encyclopedia of Chart Patterns ( Trading) by Thomas N. Bulkowski (z-lib.org).pdf
        │           ├── Thomas N. Bulkowski-Encyclopedia Of Chart Patterns.pdf
        │           └── Trades About to Happen A Modern Adaptation of the Wyckoff Method by David H. Weis, Alexander Elder (z-lib.org).pdf
        ├── 01.10.Trading.Tools
        │   └── TradingView - Bing X
        │       └── Conectando TradingView _ BingX.drawio
        ├── 01.11.Tips
        │   ├── SG_Server_v.1.1.md
        │   ├── 0001.ProcessingPostInSiteGround
        │   │   ├── flask.PostHowTo.v.01.md
        │   │   └── images
        │   │       └── flask.PostHowTo_01.png
        │   ├── 0002.Flask.InstallOnLinuxLaptop
        │   │   └── flask.InstallOnLinuxLaptop.md
        │   ├── 0003.Flask.InstallOnSG
        │   │   ├── flask.InstallOnSG.md
        │   │   └── flask.InstallOnSG.v.1.0.md
        │   ├── 0004.MySqlRemoteAccess
        │   │   ├── db_util.php
        │   │   ├── insert_record.php
        │   │   ├── MySqlRemoteAccess.md
        │   │   └── log
        │   │       └── activity.log
        │   ├── 0005.ServerStatus
        │   │   ├── ServerStatus.html
        │   │   ├── ServerStatus.md
        │   │   └── mdimages
        │   │       ├── averagenumberofpagespervisit.png
        │   │       ├── bandwidth.png
        │   │       ├── cpuusage.png
        │   │       ├── diskfree.png
        │   │       ├── pageviews.png
        │   │       ├── programexecutions.png
        │   │       ├── traficsummary.png
        │   │       └── visitorperpages.png
        │   └── 0006.AboutUvicornGuinicorn, FastAPI
        │       └── Guni_Uvi_corn_and_others_things.md
        ├── 02.02.Activity Reports
        │   ├── Kanito
        │   │   └── readme.md
        │   └── Lukas
        │       ├── Activity_report_week_10-inprogress.docx
        │       ├── Activity_report_week_10-inprogress.odt
        │       ├── Activity_report_week_10-inprogress.pdf
        │       └── Complete_Activity_Report_Week_10.md
        ├── 02.03.Reuniones
        │   ├── 000. Directrices Generales
        │   │   └── Tools.drawio
        │   └── 100. Actas
        │       ├── Acta_01_2024_03_03.odt
        │       ├── Acta_01_2024_03_03.pdf
        │       ├── Acta_02_2024_03_08.docx
        │       ├── Acta_02_2024_03_08.odt
        │       ├── Acta_02_2024_03_08.pdf
        │       ├── Acta_03_2024_05_22.md
        │       ├── Complete_Transcription_16_4_2024_2.md
        │       ├── Resumen IA_16_4_2024_1.docx
        │       ├── Resumen IA_16_4_2024_2.docx
        │       ├── Resumen IA_24_4_2024.docx
        │       ├── Transcripcion 16_4_2024.docx
        │       ├── Transcripcion 16_4_2024_2.docx
        │       └── Transcripcion 24_4_2024.docx
        ├── 02.04.AccesoServidores
        │   ├── SG.Access_2024_05_19_1120.html
        │   └── SG.Access_2024_05_19_1120.md
        ├── 10.01.ActaDeConstitucion
        │   └── 10.01.Acta.de.Constitucion.md
        ├── 20.10.RoadMap
        │   └── 10.90.Cronograma.RoadMap.md
        ├── 20.20.Cronograma
        │   └── 10.90.Cronograma.RoadMap.md
        ├── 30.10.Requerimientos
        │   ├── 20.30.Requerimentos.md
        │   ├── Brain Storm 3_3_2024.drawio
        │   ├── UIX 20_3_2024.drawio
        │   ├── z1. Recopilacion de Requerimientos.py
        │   ├── z1.Descripcion General del Proyecto.py
        │   └── z2. Documento de Especificación de Requerimientos de Software.py
        ├── 30.20.MatrizDeSeguimientos
        │   ├── 20.30.Requerimentos.md
        │   ├── Brain Storm 3_3_2024.drawio
        │   ├── UIX 20_3_2024.drawio
        │   ├── z1. Recopilacion de Requerimientos.py
        │   ├── z1.Descripcion General del Proyecto.py
        │   └── z2. Documento de Especificación de Requerimientos de Software.py
        ├── 30.30.Arquitectura
        │   ├── Arquitectura Sistema Pelusa.drawio
        │   ├── readme.md
        │   ├── Desarrollo
        │   │   ├── overView.md
        │   │   └── Backend
        │   │       ├── Amazon EC2-Windows
        │   │       │   └── readme.md
        │   │       └── Siteground
        │   │           └── php
        │   │               └── readme.md
        │   ├── Produccion
        │   │   └── 000. Paso a Produccion.md
        │   └── Testing
        │       └── 000. Paso a Testing.md
        ├── 40.10.Description Funcional
        │   └── 200. Descripcion Funcional.md
        ├── 50.00.Desarrollo
        │   ├── index.txt
        │   └── post-send
        │       ├── app.py
        │       ├── app_init.py
        │       └── run.sh
        ├── 50.00.Implementacion
        │   └── 40.00.Implementacion.md
        ├── 60.10.Test.Unitarias
        │   └── 50.10.Testing_Unit.md
        ├── 60.11.Test.Integrales
        │   └── 50.11Testing_Integral.md
        ├── 70.00.GoLive.Script
        │   └── 500. Produccion.md
    ```


