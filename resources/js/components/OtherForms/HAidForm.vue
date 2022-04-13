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
                    <h5>Скачать локальную базу данных в виде Эксель документа</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="/forms/h-aid-export/day"
                               class="btn btn-outline-info w-100 mb-2"
                               target="_blank">День</a>
                        </div>
                        <div class="col-md-3">
                            <a href="/forms/h-aid-export/week"
                               class="btn btn-outline-info w-100 mb-2"
                               target="_blank">Неделя</a>
                        </div>

                        <div class="col-md-3">
                            <a href="/forms/h-aid-export/month"
                               class="btn btn-outline-info w-100 mb-2"
                               target="_blank">Месяц</a>
                        </div>

                        <div class="col-md-3">
                            <a href="/forms/h-aid-export/year"
                               class="btn btn-outline-info w-100 mb-2"
                               target="_blank">Год</a>
                        </div>
                    </div>
                </div>
                <div class="divider divider-center-icon border-primary mt-5"><i class="bi bi-gear"></i></div>

            </div>
        </div>

        <div class="card" v-if="need_search">

            <div class="card-body">
                <h4>Поиск получателей гуманитарной помощи</h4>

                <div class="alert custom-alert-2 alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> Если искать по Ф.И.О. \ Фамилии, то выдает еще и сообщения
                    родственников этим людям!
                    <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

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

                <ul class="list-group" v-if="history.length>0||messages.length>0">
                    <small>В поиск выдает последние 20 записей</small>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="need_show_people"
                               id="needShowFindHistory" type="checkbox">
                        <label class="form-check-label" for="needShowFindHistory">Отображать список людей</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="need_show_messages"
                               id="needShowMessages" type="checkbox">
                        <label class="form-check-label" for="needShowMessages">Отображать сообщения</label>
                    </div>

                    <h4 v-if="need_show_people">Найдено людей в базе:</h4>
                    <li class="list-group-item d-flex align-items-center  justify-content-between"
                        style="cursor: pointer"
                        v-if="need_show_people"
                        :key="index"
                        @click="fill(item)"
                        v-bind:class="{'active':item.id==form.id}"
                        v-for="(item, index) in history"
                    >
                        <div class="row">
                            <div class="col-6"><p> {{ item.full_name }} </p></div>
                            <div class="col-6"><p> {{ item.passport }}
                                ({{ item.passport_issue_at || "не указана дата выдачи" }})</p>
                            </div>
                            <div class="col-12">Гум.помощь выдана <span
                                class="badge bg-info rounded-pill">{{ item.issue_at }}</span> в колличестве
                                {{ item.count || 1 }}
                            </div>
                            <div class="col-12">
                                <p v-if="item.types">Какие именно наборы выданы:
                                    <span v-for="sub in item.types">{{ sub }}, </span>
                                </p>
                            </div>
                            <div class="col-12" v-if="item.children">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex align-items-center  justify-content-between"
                                        v-for="child in item.children">
                                        <div class="row">
                                            <div class="col-12">
                                                <p>{{ child.t_name }} {{ child.f_name }} {{ child.s_name }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p>Свидетельство: {{ child.birth_certificate || "не указано" }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p>Дата выдачи:
                                                    {{ child.birth_certificate_issue_at || "не указано" }}</p>
                                            </div>
                                            <div class="col-12">
                                                <p>Дата рождения: {{ child.birthday || "не указано" }}</p>
                                            </div>
                                        </div>


                                    </li>
                                </ul>
                            </div>
                        </div>

                    </li>

                    <h4 v-if="need_show_messages">Найдено сообщений в базе:</h4>
                    <li class="list-group-item d-flex align-items-center mt-2 justify-content-between"
                        style="cursor: pointer"
                        v-if="need_show_messages"
                        :key="index"
                        v-for="(item, index) in messages"
                    >
                        <div class="row">
                            <div class="col-9"> {{ item.full_name }} <span v-if="item.identify">( {{
                                    item.identify
                                }}) </span></div>
                            <div class="col-3"><span class="badge bg-primary rounded-pill">{{ item.created_at }}</span>
                            </div>
                            <div class="col-12 mt-2"><p class="w-100">
                                {{ item.sms }}
                            </p></div>
                        </div>


                    </li>
                    <p class="mt-2" v-if="need_show_people&&history.length==0">Данных о человеке нет по этому
                        запросу</p>
                    <p class="mt-2" v-if="need_show_messages&&messages.length==0">Сообщений нет по данному запросу</p>
                </ul>
                <p class="mt-2" v-else>По данному запросу ничего нет</p>
                <div class="divider divider-center-icon border-primary "><i class="bi bi-arrow-down-circle"></i></div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Работа с гуманитарной помощью</h4>
                <form v-on:submit.prevent="submit" ref="haid">

                    <div class="form-group">
                        <label class="form-label">Какой набор выдается</label>
                        <div class="list-group">
                            <label class="list-group-item" v-for="item in types">
                                <input class="form-check-input me-2" type="checkbox" name="typeCategory"
                                       v-model="form.types" :value="item"> {{ item }}
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="tName">Фамилия получателя<span
                                    style="color:red;">*</span></label>
                                <input class="form-control" id="tName" type="text" placeholder="Иванов"
                                       v-model="form.t_name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="fName">Имя получателя<span
                                    style="color:red;">*</span></label>
                                <input class="form-control" id="fName" type="text" placeholder="Иван"
                                       v-model="form.f_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="sName">Отчество получателя</label>
                        <input class="form-control" id="sName" type="text" placeholder="Иванович"
                               v-model="form.s_name">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="inputPassport">Серия и номер паспорта<span
                                    style="color:red;">*</span></label>
                                <input class="form-control" id="inputPassport" type="text" placeholder="ВК 000000"
                                       v-model="form.passport" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="inputPassportIssue">Дата выдачи паспорта</label>
                                <input class="form-control" id="inputPassportIssue" type="date"
                                       v-model="form.passport_issue_at">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="description">Дополнительная информация о получателе</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>



                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="inputDate">Дата получения<span
                                    style="color:red;">*</span></label>
                                <input class="form-control form-control-clicked" id="inputDate"
                                       v-model="form.issue_at" required
                                       type="datetime-local">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="inputCity">Город получения<span
                                    style="color:red;">*</span></label>
                                <input class="form-control" id="inputCity" type="text" placeholder="Мариуполь"
                                       v-model="form.city" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="inputAddress">Адрес получения</label>
                                <input class="form-control" id="inputAddress" type="text"
                                       placeholder="ул. Университетская, 10а"
                                       v-model="form.address" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <h6>Информация о всех датах получения наборов человеком</h6>
                        <div class="row" v-for="(item,index) in form.issue_date_history">
                            <div class="col-12">
                                <a type="button" class="text-secondary small mb-2 w-100"
                                   @click="removeIssue(index)">Удалить</a>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'dateIssue'+index">Дата получения</label>
                                    <input class="form-control" :id="'dateIssue'+index" type="date"
                                           v-model="form.issue_date_history[index].date" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'comment'+index">Комментарий оператора</label>
                                    <input class="form-control" :id="'comment'+index" type="text"
                                           v-model="form.issue_date_history[index].comment" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'type'+index">Тип набора</label>

                                    <select :name="'type'+index" :id="'type'+index"
                                            class="form-control"
                                            v-model="form.issue_date_history[index].type" required>
                                        <option :value="type" v-for="type in types">{{ type }}</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center"
                                @click="addIssueDate"
                                type="button">Добавить еще дату
                        </button>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input form-check-success"
                               v-model="form.has_children"
                               id="hasChildren" type="checkbox">
                        <label class="form-check-label" for="hasChildren">Есть дети</label>
                    </div>

                    <div class="form-group" v-if="form.has_children">

                        <h6>Информация о детях</h6>
                        <div class="row" v-for="(item,index) in form.children">
                            <div class="col-12">
                                <a type="button" class="text-secondary small mb-2 w-100" v-if="index>0"
                                   @click="remove(index)">Удалить</a>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'childTName'+index">Фамилия</label>
                                    <input class="form-control" :id="'childTName'+index" type="text"
                                           placeholder="Иванов"
                                           v-model="form.children[index].t_name" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'childFName'+index">Имя</label>
                                    <input class="form-control" :id="'childFName'+index" type="text"
                                           placeholder="Алексей"
                                           v-model="form.children[index].f_name" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'childSName'+index">Отчество</label>
                                    <input class="form-control" :id="'childSName'+index" type="text"
                                           placeholder="Иванович"
                                           v-model="form.children[index].s_name" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'birth'+index">Дата рождения ребенка</label>
                                    <input class="form-control" :id="'birth'+index" type="date"
                                           v-model="form.children[index].birthday" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'certificate'+index">Серия и номер свидетельства о
                                        рождении</label>
                                    <input class="form-control" :id="'certificate'+index" type="text"
                                           placeholder="1-НО 000000"
                                           v-model="form.children[index].birth_certificate" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" :for="'certificateIssue'+index">Дата выдачи</label>
                                    <input class="form-control" :id="'certificateIssue'+index" type="date"
                                           v-model="form.children[index].birth_certificate_issue_at" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" :for="'moreInfo'+index">Дополнительная информация</label>
                                    <textarea class="form-control" :id="'moreInfo'+index"
                                           v-model="form.children[index].comment" required>
                                    </textarea>
                                </div>
                            </div>


                        </div>

                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center"
                                @click="addChild"
                                type="button">Добавить еще ребенка
                        </button>
                    </div>


                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="message" role="alert">
                        <i class="bi bi-check-circle"></i>{{ message }}
                    </div>


                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                            type="submit" :disabled="loader">
                        <span v-if="!loader&&form.id==null">Добавить в базу</span>
                        <span v-if="!loader&&form.id!=null">Обновить данные человека </span>
                        <svg class="bi bi-arrow-right-short" width="24" height="24" viewBox="0 0 16 16"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>

                        <span v-if="loader"><img src="/img/loader.gif" class="loader-btn" alt=""></span>


                    </button>

                    <button
                        class="btn btn-outline-warning w-100 d-flex mt-3 align-items-center justify-content-center"
                        type="reset" :disabled="loader" v-if="form.id!=null">
                        Очистить форму
                    </button>

                </form>
            </div>
        </div>
    </div>
</template>
<script>


export default {

    watch:{
      'form.types':{
          handler: function(newValue) {
             if (this.form.types.indexOf("Детский набор")!=-1)
                 this.form.has_children = true
              else
                 this.form.has_children = false
          },
          deep: true
        }
    },
    data() {
        return {
            loader: false,
            messageType: 0,
            message: null,
            message2: null,
            search: null,
            need_sync: false,
            need_search: false,
            need_show_people: true,
            need_show_messages: false,

            history: [],
            messages: [],
            types: [
                "Продуктовый и гигиенический набор",
                "Детский набор",
            ],
            file: '',
            form: {
                id: null,
                t_name: null,
                f_name: null,
                s_name: null,
                passport: null,
                issue_at: null,
                issue_date_history: [

                ],
                description: null,

                city: "Мариуполь",
                address: null,

                has_children: false,
                passport_issue_at: null,
                count: 1,
                children: [{
                    t_name: null,
                    f_name: null,
                    s_name: null,
                    birth_certificate: null,
                    birth_certificate_issue_at: null,
                    birthday: null,
                    comment: null,
                }],
                types: ["Продуктовый и гигиенический набор"]

            }
        }
    },
    mounted() {
        let date = new Date();

        let month = ('0' + (date.getMonth() + 1)).slice(-2);
        let day = ('0' + date.getDate()).slice(-2);
        let year = date.getFullYear();

        let h = date.getHours();
        let m = date.getMinutes()

        let htmlDate = year + '-' + month + '-' + day + "T" + h + ":" + m;

        this.form.issue_at = htmlDate

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
            ).then(() => {
                this.message2 = "Успешное обновление информации!"
                this.messageType = 0;
                this.loader = false
                this.$refs.excel.reset();
            }).catch(() => {
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
                this.history = resp.data.history.data
                this.messages = resp.data.messages.data


                this.$refs.search.reset();
                this.loader = false

            }).catch(() => {
                this.loader = false
            })
        },
        fill(item) {

            this.form = Object.assign({}, item);

            console.log(this.form.issue_at)

            if (item.f_name == null && item.t_name == null) {
                let tmp = this.form.full_name.split(" ");
                this.form.t_name = tmp[0] || ""
                this.form.f_name = tmp[1] || ""
                this.form.s_name = tmp[2] || ""
            }

            if (item.children)
                this.form.has_children = true;

            let date = new Date(this.form.issue_at);

            let month = ('0' + (date.getMonth() + 1)).slice(-2);
            let day = ('0' + date.getDate()).slice(-2);
            let year = date.getFullYear();

            let h = date.getHours();
            let m = date.getMinutes()

            if (("" + h).length == 1)
                h = "0" + h;

            if (("" + m).length == 1)
                m = "0" + m;

            this.form.issue_at = year + '-' + month + '-' + day + "T" + h + ":" + m;

            console.log(this.form.issue_at)
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
        },
        addChild() {
            this.form.children.push({
                t_name: null,
                f_name: null,
                s_name: null,
                birth_certificate: null,
                birth_certificate_issue_at: null,
                birthday: null,
                comment: null,
            });
        },
        remove(index) {
            this.form.children.splice(index, 1);
        },
        addIssueDate() {
            this.form.issue_date_history.push({
                date: null,
                count: 1,
                comment: '',
                type: 'Продуктовый и гигиенический набор',
            });
        },
        removeIssue(index) {
            this.form.issue_date_history.splice(index, 1);
        },

    }
}
</script>
