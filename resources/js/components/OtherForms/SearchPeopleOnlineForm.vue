<template>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <h4>{{ form.type ? "Добавление в Базу" : "Заявк на поиск" }}</h4>

                <form v-on:submit.prevent="submit" ref="people">

                    <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>Все добавляемые заявки на поиск обрабатываются оператором.
                        После
                        обработки с вами свяжутся (от 1 часа до 24х часов в зависимости от загруженности)!
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputTname">Фамилия<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputTname" type="text" placeholder="Иванов"
                               v-model="form.tname" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputFname">Имя<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputFname" type="text" placeholder="Иван"
                               v-model="form.fname" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputSname">Отчество</label>
                        <input class="form-control" id="inputSname" type="text" placeholder="Иванович"
                               v-model="form.sname">
                    </div>

                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input form-check-success"
                               v-model="have_a_photo"
                               id="have_a_photo" type="checkbox">
                        <label class="form-check-label" for="have_a_photo">Могу предоставить фотографии</label>
                    </div>


                    <div class="form-group" v-if="have_a_photo">
                        <div class="card">
                            <div class="card-body">
                                <div class="file-upload-card">
                                    <svg class="bi bi-file-earmark-arrow-up text-primary" width="48" height="48"
                                         viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"></path>
                                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"></path>
                                        <path fill-rule="evenodd"
                                              d="M8 12a.5.5 0 0 0 .5-.5V7.707l1.146 1.147a.5.5 0 0 0 .708-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L7.5 7.707V11.5a.5.5 0 0 0 .5.5z"></path>
                                    </svg>
                                    <h5 class="mt-2 mb-4">Згрузка фотографий пользователя</h5>

                                    <form action="#" method="GET">
                                        <div class="form-file">
                                            <input class="form-control d-none" id="customFile" multiple ref="files"
                                                   type="file"
                                                   v-on:change="handleFileUpload()">
                                            <label class="form-file-label justify-content-center" for="customFile"><span
                                                class="form-file-button btn btn-primary shadow w-100">Загрузить файл</span></label>
                                        </div>
                                    </form>
                                    <h6 class="mt-4 mb-0">Поддерживаемые типы</h6><small>.jpg .png .jpeg .gif</small>
                                    <h6 class="mt-4 mb-0">Максимальный размер файла <strong>10мб</strong></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="file_message" role="alert">
                        <i class="bi bi-check-circle"></i> {{ file_message }}
                    </div>


                    <div class="form-group" v-if="files.length>0&&have_a_photo">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex align-items-center justify-content-between"
                                        v-for="(file, index) in files">
                                        {{ file.name }} <span class="m-1 badge rounded-pill bg-success">Успех</span>
                                    </li>

                                </ul>

                                <button type="button" class="btn btn-primary w-100 mt-3"
                                        @click="removeFiles">Очистить
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input form-check-success"
                               v-model="form.sex"
                               id="sex" type="checkbox">
                        <label class="form-check-label" for="sex">{{ form.sex ? "Женщина" : "Мужчина" }}</label>
                    </div>

                    <div class="form-check form-switch mb-2" v-if="form.type==0">

                        <input class="form-check-input form-check-success"
                               v-model="dont_know_age"
                               id="dontKnow" type="checkbox">
                        <label class="form-check-label"
                               for="dontKnow">{{ dont_know_age ? "Я не знаю возраст" : "Я знаю возраст" }}</label>
                    </div>

                    <div class="form-group" v-if="dont_know_age==false">
                        <label class="form-label" for="inputBirthday">Дата рождения</label>
                        <input class="form-control form-control-clicked" id="inputBirthday"
                               v-model="form.birth"
                               type="date">
                    </div>


                    <div class="form-group" v-if="form.type==1">
                        <label class="form-label" for="inputPhoenixNum">Номер феникс</label>
                        <input class="form-control" id="inputPhoenixNum" type="text"
                               placeholder="(071) 000-00-00"
                               v-mask="['(###) ###-##-##']"
                               v-model="form.phoenix_num">
                    </div>

                    <div class="form-group" v-if="form.type==1">
                        <label class="form-label" for="inputEmail">Ваша почта</label>
                        <input class="form-control" id="inputEmail" type="email"
                               placeholder="test@gmail.com"
                               v-model="form.email">
                    </div>


                    <div class="form-group" v-if="form.type==0&&dont_know_age==true">
                        <label class="form-label" for="inputAge">Выглядит на возраст</label>
                        <div class="row">
                            <div class="col-6">
                                <input class="form-control" id="inputAgeFrom" type="number" placeholder="От 20 лет"
                                       v-model="form.age_from">
                            </div>
                            <div class="col-6">
                                <input class="form-control" id="inputAgeTo" type="number" placeholder="До 30 лет"
                                       v-model="form.age_to">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="inputCity">Название населенного пункта<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputCity" type="text" placeholder="город Донецк"
                               v-model="form.city" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="inputAddress">Улица и номер строения<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputAddress" type="text" placeholder="ул. Артема, 2а"
                               v-model="form.address" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="regionInput">Регион \ район</label>
                        <input class="form-control" id="regionInput" type="text" placeholder="Куйбышевский район"
                               v-model="form.region">
                    </div>

                    <div class="form-group">
                        <h6>Контактная информцаия ({{ form.phones.length }}/{{ max_phones }})</h6>
                        <div v-for="(item,index) in form.phones">
                            <a type="button" class="text-secondary small mb-2 w-100"
                               @click="remove(index)">Удалить</a>
                            <div class="form-group">
                                <label class="form-label" :for="'phone'+index">Номер телефона \ Почта <span
                                    style="color:red;">*</span></label>
                                <input class="form-control" :id="'phone'+index" type="text" placeholder="Контакт"
                                       v-model="form.phones[index].phone" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="'description-'+index">Пояснение</label>
                                <textarea class="form-control" :id="'description-'+index" placeholder="Детали"
                                          v-model="form.phones[index].description"></textarea>
                            </div>

                        </div>


                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center"
                                v-if="this.max_phones > this.form.phones.length"
                                @click="addNewPhone"
                                type="button">
                            <span v-if="this.form.phones.length==0">Добавить контакт</span>
                            <span v-if="this.form.phones.length>0">Добавить еще контакт</span>
                        </button>
                    </div>

                    <!--                    <div class="form-group">
                                            <label class="form-label" for="inputYourPhone">Ваш номер телефон<span
                                                style="color:red;">*</span></label>
                                            <input class="form-control" id="inputYourPhone" type="text" placeholder="(071) 000-00-00"
                                                   v-mask="['(###) ###-##-##']" v-model="form.phone" required>
                                        </div>-->

                    <div class="form-group">
                        <label class="form-label" for="story">История человека</label>
                        <textarea class="form-control" id="story" name="story" cols="3" rows="5"
                                  v-model="form.story"
                                  placeholder="История пропажи человека"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Дополнительная информация о человеке</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>

                    <div class="form-group" v-if="form.type==0">
                        <label class="form-label" for="inputDate">Не выходит на связь с</label>
                        <input class="form-control form-control-clicked" id="inputDate"
                               v-model="form.searched_from"
                               type="datetime-local">
                    </div>

                    <div class="form-group" v-if="form.type==1">
                        <label class="form-label" for="passport">Паспортные данные</label>
                        <textarea class="form-control" id="passport" name="passport" cols="3" rows="5"
                                  v-model="form.passport"
                                  placeholder="Серия и номер пспорта или другого документа"></textarea>
                    </div>

                    <div class="form-group" v-if="form.type==1">
                        <label class="form-label" for="evacuationPlace">Планируемое место эвакуации</label>
                        <input class="form-control" id="evacuationPlace" type="text" placeholder="г. Ростов"
                               v-model="form.evacuation_place">
                    </div>


                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="message" role="alert">
                        <i class="bi bi-check-circle"></i>{{ message }}
                    </div>

                    <vue-recaptcha
                        sitekey="6LdXNsAeAAAAAGXKzMNzpWRyRj_BZU62hfN0_dAJ"
                        :loadRecaptchaScript="true"
                        ref="recaptcha"
                        type="invisible"
                        size="invisible"
                        @verify="onCaptchaVerified"
                        @expired="onCaptchaExpired"
                    >
                    </vue-recaptcha>

                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                            type="submit" :disabled="loader">
                        <span v-if="!loader">Отправить запрос
                         <svg class="bi bi-arrow-right-short" width="24" height="24" viewBox="0 0 16 16"
                              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>
                        </span>
                        <span v-else><img src="/img/loader.gif" class="loader-btn" alt=""></span>


                    </button>


                    <a href="https://t.me/shelter_dpr_bot"
                       class="btn btn-link w-100 d-flex align-items-center justify-content-center">Перейти в бота
                    </a>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import {VueRecaptcha} from 'vue-recaptcha';

export default {
    components: {'vue-recaptcha': VueRecaptcha,},
    props: {
        userId: {
            type: String,
            default: null
        },
        type: {
            type: String,
            default: 0
        },
    },
    watch: {
        'form.recaptcha': function () {

            let photos = []

            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];
                photos.push(file.name)
            }

            axios.post('/forms/need-people-search-online', this.form).then(resp => {

                this.message = "Заявка успешно добавлена!"
                this.messageType = 0;

                this.loader = false

                if (resp.data.upload_to) {
                    let formData = new FormData();
                    formData.append("upload_to", resp.data.upload_to)
                    for (var i = 0; i < this.files.length; i++) {
                        let file = this.files[i];
                        formData.append('images[' + i + ']', file);
                    }

                    axios.post('/forms/upload-photos',
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then((resp) => {
                        this.files = []

                        setTimeout(() => {
                            window.location.href = "https://t.me/shelter_dpr_bot"
                        }, 2000)
                    }).catch(function () {
                        this.files = []
                    });

                }

                this.onCaptchaExpired()

                this.$refs.people.reset();

                if (this.files.length==0)
                  setTimeout(() => {
                      window.location.href = "https://t.me/shelter_dpr_bot"
                  }, 2000)
            }).catch(() => {
                this.message = "Ошибка добавления заявки!"
                this.messageType = 1;
                this.loader = false
            })
        },
    },
    data() {
        return {
            files: [],
            loader: false,
            messageType: 0,
            message: null,
            file_message: null,
            max_phones: 20,
            dont_know_age: false,
            have_a_photo: false,
            form: {
                fname: null,
                sname: null,
                tname: null,
                birth: null,
                age_from: null,
                age_to: null,
                sex: 0,
                photos: [],
                phones: [],
                city: null,
                region: null,
                address: null,
                story: null,
                description: null,
                status: 0,
                for: 0,
                searched_from: null,
                phoenix_num: null,
                email: null,
                type: 0,
                passport: null,
                evacuation_place: null,
                recaptcha: null,
                handler_type: 1,

            }
        }
    },
    mounted() {
        this.form.type = this.type
    },
    methods: {
        prepareImage(file) {
            return URL.createObjectURL(file)
        },
        onCaptchaVerified: function (recaptchaToken) {
            this.form.recaptcha = recaptchaToken
            this.validateCaptcha = true

        },
        onCaptchaExpired: function () {
            this.$refs.recaptcha.reset();
        },
        handleFileUpload() {

            const files = this.$refs.files.files;
            let msg = "";
            let max_count = 10

            for (let i = 0; i < files.length; i++) {
                const regex = new RegExp("\.(.jpg|.gif|.png|.jpeg)$");

                let isValid = true
                if (files[i].size > 10485760) {
                    msg += files[i].name + " слишком большой, максимальный размер 10мб! ";

                    isValid = false;
                }

                if (!regex.test(files[i].name)) {
                    msg += files[i].name + " имеет не верный формат! ";
                    this.messageType = 1
                    isValid = false
                }


                if (isValid && max_count > 0) {
                    max_count--
                    this.files.push(files[i])
                } else {
                    this.messageType = 1
                    this.file_message = msg
                }
            }


        },
        submit() {
            this.form.user_id = this.userId;
            this.loader = true
            this.message = null
            this.messageType = 0;

            this.$refs.recaptcha.execute();
        },
        addNewPhone() {
            let find = false;

            if (this.form.phones.length > 0)
                find = this.form.phones.filter(item => item.phone.trim() === "").length > 0;

            if (!find && this.max_phones > this.form.phones.length)
                this.form.phones.push({
                    phone: "",
                    description: null,
                });
        },
        removeFiles() {
            this.$refs.files.value = null;
            this.files = []
            this.file_message = null
        },
        remove(index) {
            this.form.phones.splice(index, 1);

        }

    }
}
</script>
