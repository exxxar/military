<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input form-check-success"
                           v-model="need_sync"
                           id="needDrinkingWater" type="checkbox">
                    <label class="form-check-label" for="needDrinkingWater">Нужна синхронизация базы</label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input form-check-success"
                           v-model="need_search"
                           id="needSearch" type="checkbox">
                    <label class="form-check-label" for="needSearch">Нужен поиск по базе</label>
                </div>
            </div>
        </div>

        <div class="card" v-if="need_sync">
            <div class="card-body">
                <h4>Импорт данных из других документов эксель</h4>
                <small>Вы можете предварительно скачать шаблон <a href="/h-aid.xlsx" target="_blank">по
                    ссылке </a></small>
                <form v-on:submit.prevent="uploadSubmit" ref="excel" class="mt-3">

                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="message2" role="alert">
                        <i class="bi bi-check-circle"></i>{{ message2 }}
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="excelFile">Загрузить Эксель документ</label>
                        <input class="form-control border-0" type="file" id="excelFile" ref="file"
                               v-on:change="handleFileUpload()">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                                type="submit" :disabled="loader">
                        <span v-if="!loader">Синхронизировать базу данных
                         <svg class="bi bi-arrow-right-short" width="24" height="24" viewBox="0 0 16 16"
                              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>
                        </span>
                            <span v-else><img src="/img/loader.gif" class="loader-btn" alt=""></span>


                        </button>
                    </div>
                </form>
                <div class="divider divider-center-icon border-primary mt-5"><i class="bi bi-gear"></i></div>
                <div class="alert alert-success" role="alert">
                    В начале рабочего дня синхронизируйте свои базы данных! Так работа будет продуктивнее! Скачайте
                    данный документ и передайте другим операторам.
                    При этом другие операторы дадут вам свою локальную копию базы!
                </div>
                <div class="form-group">
                    <a href="/forms/h-aid-export"
                       class="btn btn-outline-info w-100"
                       target="_blank">Скачать локальную базу данных в виде Эксель документа</a>
                </div>
                <div class="divider divider-center-icon border-primary mt-5"><i class="bi bi-gear"></i></div>

            </div>
        </div>

        <div class="card" v-if="need_search">

            <div class="card-body">
                <h4>Поиск получателей гуманитарной помощи</h4>
                <form v-on:submit.prevent="searchSubmit" ref="search">

                    <div class="form-group">
                        <label class="form-label" for="search">Ф.И.О. получателя или серия и номер паспорта<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="search" type="text" placeholder="Иванов Иван Иванович"
                               v-model="search" required>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                                type="submit" :disabled="loader">
                        <span v-if="!loader">Найти в базе
                         <svg class="bi bi-arrow-right-short" width="24" height="24" viewBox="0 0 16 16"
                              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>
                        </span>
                            <span v-else><img src="/img/loader.gif" class="loader-btn" alt=""></span>


                        </button>
                    </div>
                </form>

                <ul class="list-group" v-if="history.length>0">
                    <small>В поиск выдает последние 10 записей</small>
                    <li class="list-group-item d-flex align-items-center justify-content-between"
                        :key="index"
                        @click="fill(item)"
                        v-for="(item, index) in history"
                    >
                        {{ item.full_name }}<span class="badge bg-primary rounded-pill">{{ item.issue_at }}</span>
                    </li>
                </ul>
                <div class="divider divider-center-icon border-primary "><i class="bi bi-arrow-down-circle"></i></div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Работа с гуманитарной помощью</h4>
                <form v-on:submit.prevent="submit" ref="haid">

                    <div class="form-group">
                        <label class="form-label" for="inputIndex">Внешний номер заявки (не обязтельно)</label>
                        <input class="form-control" id="inputIndex" type="text" placeholder="00000001"
                               v-model="form.index">
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="inputFullName">Ф.И.О. получателя<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputFullName" type="text" placeholder="Иванов Иван Иванович"
                               v-model="form.full_name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputPassport">Серия и номер паспорта<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputPassport" type="text" placeholder="ВК 000000"
                               v-model="form.passport" required>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="description">Дополнительная информация о получателе</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="inputDate">Дата получения<span
                            style="color:red;">*</span></label>
                        <input class="form-control form-control-clicked" id="inputDate"
                               v-model="form.issue_at" required
                               type="datetime-local">
                    </div>


                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="message" role="alert">
                        <i class="bi bi-check-circle"></i>{{ message }}
                    </div>


                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                            type="submit" :disabled="loader">
                        <span v-if="!loader">Добавить
                         <svg class="bi bi-arrow-right-short" width="24" height="24" viewBox="0 0 16 16"
                              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>
                        </span>
                        <span v-else><img src="/img/loader.gif" class="loader-btn" alt=""></span>


                    </button>

                </form>
            </div>
        </div>
    </div>
</template>
<script>


export default {

    data() {
        return {
            loader: false,
            messageType: 0,
            message: null,
            message2: null,
            search: null,
            need_sync: false,
            need_search: false,
            history: [],
            file: '',
            form: {
                index: null,
                full_name: null,
                passport: null,
                issue_at: null,
                description: null


            }
        }
    },
    methods: {

        uploadSubmit() {
            this.loader = true

            this.message2 = null;

            let formData = new FormData();
            formData.append('file', this.file);
            axios.post('/forms/h-aid-import',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then (()=> {
                this.message2 = "Успешное обновление информации!"
                this.messageType = 0;
                this.loader = false
                this.$refs.excel.reset();
            }).catch( () => {
                this.loader = false
                this.message2 = "Ошибка обновления информации!"
                this.messageType = 1;
            });
        },
        searchSubmit() {
            this.loader = true

            axios.post('/forms/h-aid-search', {
                search: this.search
            }).then(resp => {
                this.history = resp.data.data
                this.$refs.search.reset();
                this.loader = false

            }).catch(() => {
                this.loader = false
            })
        },
        fill(item) {
            this.form = item;
        },
        submit() {
            this.form.user_id = this.userId;
            this.loader = true
            this.message = null
            this.messageType = 0;

            axios.post('/forms/h-aid', this.form).then(resp => {

                this.message = "Информация успешно добавлена!"
                this.messageType = 0;

                this.$refs.haid.reset();
                this.loader = false

                setTimeout(() => {
                    window.location.reload()
                }, 2000)
            }).catch(() => {
                this.message = "Ошибка добавления информации!"
                this.messageType = 1;
                this.loader = false
            })

        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        }

    }
}
</script>
