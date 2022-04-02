    <?php 
        include_once(__DIR__."/ui_components/start.php"); 
        $pageName = "Translate";
        include_once(__DIR__."/ui_components/head.php"); 
    ?>
    <body data-topbar="dark">
    <style>
        #translationsTable th{
            min-width:300px;
        }
        #translationsTable th.id, td.id{
            left:0px;
            min-width:50px !important;
            position: absolute;
            background-color:white;
        }
        #translationsTable th.key, td.key{
            left:50px;
            min-width:200px !important;
            position: absolute;
            background-color:white;
            border-right: 1px solid silver !important;
        }
    </style>
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            
            <?php include_once(__DIR__."/ui_components/header.php"); ?>
            
            <?php include_once(__DIR__."/ui_components/sidebar.php"); ?>
            
            <?php setFileName('translate.php'); ?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content mb-5">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?=t('Translations')?></h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?=t('Home')?></a></li>
                                            <li class="breadcrumb-item active"><?=t('Translations')?></li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                    </div> <!-- container-fluid -->

                    <div class="container-fluid">

        
                        <div class="row" id="translatedFiles">
                            <script>
                            // let loc = window.location.pathname;
                            // let dir = loc.substring(0, loc.lastIndexOf('/'));
                            // console.log(typeof data);
                            (async () => {
                                const data = await fetch(`${dir}/translation_service/coreApi/translateApi.php?getTranslatedFiles`);
                                const translatedFiles = await data.json();
                                // console.log(translatedFiles);

                                let table = document.getElementById('translatedFiles');
                                //console.log(translatedFiles);
                                let id = 0;
                                translatedFiles.forEach(value => {
                                table.insertAdjacentHTML('afterbegin', `
                                    <div class="col-lg-4 col-md-6 col-12 mb-2">
                                        <button class="btn btn-outline-primary w-100" onclick="getTranslations('${value}')">${value.replace(/\.\.\//g,'')}</button>
                                    </div>
                                `);
                                
                                });
                            })();

                            function getTranslations(fileName){
                                document.getElementById('fileName').innerHTML = fileName.replace(/\.\.\//g,'');
                                (async () => {
                                const data = await fetch(`${dir}/translation_service/coreApi/translateApi.php?getTranslationFileAllLanguages&fileName=${fileName}`);
                                const translations = await data.json();

                                let thead = document.getElementById('availableLanguages');
                                thead.innerHTML = `
                                    <th scope="col" class="border-0 id" >#</th>
                                    <th scope="col" class="border-0 key">Key</th>
                                    <th scope="col" class="border-0 scrolable"></th>
                                `;
                                let tbody = document.getElementById('tbody');

                                // console.log(translations);
                                // console.log(Object.keys(translations).length)
                                //console.log(translations[Object.keys(translations)[0]]);
                                let availableLang = [];
                                for (const [key, value] of Object.entries(translations)) {                           
                                    thead.innerHTML += `
                                    <th scope="col" class="border-0 scrolable">${key}</th>
                                    `;

                                    // tbody.innerHTML += `
                                    // <tr id="${key}"></tr>
                                    // `;
                                    availableLang.push(key);
                                }
                                // console.log(availableLang);
                                // console.log(translations['hy']['fsffsfs']);
                                let count = 0;
                                tbody.innerHTML = '';
                                for (const [key, value] of Object.entries(translations[availableLang[0]])){
                                    if(key == 'lastUpdate') break;
                                    tbody.innerHTML += `
                                        <tr id="row_${count}"></tr>
                                    `;
                                    let col = document.getElementById(`row_${count}`);
                                    col.innerHTML = `
                                        <td class="id">${count++}</td>
                                        <td class="key">${key}</td>
                                        <td class="firstScrolable"></td>

                                    `;
                                    
                                    availableLang.forEach(lang => {
                                        // let col = document.getElementById(lang);
                                    
                                        let val = translations[lang][key];
                                        col.innerHTML +=  `
                                            <td onclick="updateValue(this,'${fileName}','${lang}','${key}','${(val != '') ? val.replaceAll(/'/g,"\\'") : key.replace(/'/g, "\\'")}')">${(val != '') ? val : key}</td>
                                        `;
                                    });
                                }                            
                                
                                
                                    
                            })();
                            }
                            function updateValue(elem, fileName,  lang, key, val){
                                // console.log(elem);
                                //console.log(elem.outerHTML);
                                // elem.outerHTML = `
                                //     <td>
                                //     <input type="text" value="${val}" onfocusout="updateTranslationByKey(this, '${fileName}', '${lang}', '${key}', this.value)" autofocus>
                                //     </td>
                                // `;
                                elem.outerHTML = `
                                    <td>
                                        <textarea style="width:100%" onfocusout="updateTranslationByKey(this, '${fileName}', '${lang}', '${key}', this.value)" autofocus>${val}</textarea>
                                    </td>
                                `;
                            }

                            function updateTranslationByKey(elem, fileName, lang, key, val){
                                // console.log(fileName);
                                // console.log(lang);
                                // console.log(key);
                                // console.log(val);
                                val = val.replace(/\n/g, "<br>");
                                (async () => {
                                    // coreApi/translateApi.php?updateTranslationByKey&fileName=../test.php&langCode=hy&key=a1&value=testtest
                                    const data = await fetch(`${dir}/translation_service/coreApi/translateApi.php?updateTranslationByKey&fileName=${fileName}&langCode=${lang}&key=${key}&value=${val}`);
                                    const response = await data.text();
                                    //console.log(response);
                                    elem.parentElement.outerHTML = `
                                    <td onclick="updateValue(this,'${fileName}','${lang}','${key}','${(val != '') ? val.replace(/'/g, "\\'") : key.replace(/'/g, "\\'")}')">${(val != '') ? val : key }</td>
                                `;
                                })();
                                // console.log(elem.parentElement.outerHTML);
                                
                            }
                            </script>
                            
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card card-small mb-4" >
                                    <div class="card-header border-bottom">
                                        <h6 class="m-0" id="fileName"></h6>
                                    </div>
                                    <div class="card-body p-0 text-center" style="overflow-x:auto;">
                                        <table class="table mb-0" id="translationsTable">
                                        <thead class="bg-light" id="thead">
                                            <tr id="availableLanguages">
                                                
                                            <!--<th scope="col" class="border-0 id" >#</th>
                                            <th scope="col" class="border-0 key">Key</th>
                                            <th scope="col" class="border-0 scrolable">Lang1</th>
                                            <th scope="col" class="border-0 scrolable">Lang2</th>
                                            -->
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <!-- <tr>
                                            <td class="id">1</td>
                                            <td class="key">Ali</td>
                                            <td class="firstScrolable">Kerry</td>
                                            <td>Russian Federation</td>
                                            <td>Gdańsk</td>
                                            <td>107-0339</td>
                                            </tr>
                                            -->
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="container-fluid">

                <div class="row justify-content-center">
                <!-- Available languages Component -->
                <div class="col">
                <table class="table bg-white rounded">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">File Name</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="translatedFiles">
                    <script>
                        // let loc = window.location.pathname;
                        // let dir = loc.substring(0, loc.lastIndexOf('/'));
                        // console.log(typeof data);
                        (async () => {
                            const data = await fetch(`${dir}/translation_service/coreApi/translateApi.php?getTranslatedFiles`);
                            const translatedFiles = await data.json();
                            // console.log(translatedFiles);

                            let table = document.getElementById('addTranslatedFile');
                            let id = 0;
                            translatedFiles.forEach(value => {
                            table.insertAdjacentHTML('beforebegin', `
                            <tr>
                                <th scope="row">${++id}</th>
                                <td>${value}</td>
                                <td>

                                <button type="button" class="btn btn-danger w-100" onclick="removeTranslatedFile('${value}')">
                                    Delete 
                                </button>
                                </td>
                            </tr> 
                            `);
                            
                            });
                        })();
                        
                        function removeTranslatedFile(fileName){
                            //console.log(fileName);
                        let xhr = new XMLHttpRequest();
                        
                        xhr.open('GET', dir+'/translation_service/coreApi/translateApi.php?removeTranslatedFile&fileName=' + fileName);
                        xhr.send();
                        location.reload();
                        }

                        

                        
                    </script> 
                        
                        <tr id="addTranslatedFile">
                            <th scope="row" class="text-center">
                            <span class="text-success">
                                Add new language
                            </span>
                            </th>
                            <td>
                            <input type="text" class="form-control" id="fileNameToAdd" placeholder="File name"> </div>
                            </td>
                            <!-- <td>
                            <input type="text" class="form-control" id="langName" placeholder="Language Name ex. Հայերեն"> </div>
                            </td> -->
                            <td>
                            <button type="button" class="btn btn-success w-100" onclick="addTranslatedFile($('#fileNameToAdd').val())">
                                
                                Add Translated file 
                            </button>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    <script>
                    function addTranslatedFile(fileName){
                        let xhr = new XMLHttpRequest();
                        xhr.open('GET', `${dir}/translation_service/coreApi/translateApi.php?addTranslatedFile&fileName=${fileName}`);
                        xhr.send();
                        location.reload();
                    }
                    </script>
                </div>
                </div>
                    <!-- End Page-content -->
                    <?php include_once(__DIR__."/ui_components/footer.php"); ?>
                    
                </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <?php include_once(__DIR__."/ui_components/foot.php"); ?>