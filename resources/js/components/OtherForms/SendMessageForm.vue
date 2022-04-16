<template>
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input form-check-success"
                           v-model="need_search"
                           id="needSearch" type="checkbox">
                    <label class="form-check-label" for="needSearch">Нужен поиск сообщений</label>
                </div>
            </div>
        </div>

        <div class="card" v-if="need_search">

            <div class="card-body">
                <h4>Поиск сообщений от родственников</h4>
                <h6>Ответы родственников из Мариуполя будут вносится в базу с 18.04</h6>

                <div class="alert custom-alert-2 alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> Для поиска сообщений введите Ф.И.О. родственника или своё Ф.И.О.
                    <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <form v-on:submit.prevent="searchSubmit" ref="search">

                    <div class="form-group">
                        <label class="form-label" for="search">Ф.И.О. родственника или ваше, паспортные данные ваши или
                            родственник<span
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

                <ul class="list-group" v-if="messages.length>0">
                    <small>В поиск выдает последние 20 записей</small>
                    <h5 class="mt-2">Найдено сообщений в базе:</h5>
                    <li class="list-group-item d-flex align-items-center mt-2 justify-content-between"
                        style="cursor: pointer"
                        :key="index"
                        v-for="(item, index) in messages"
                    >
                        <div class="row">
                            <div class="col-12"><strong>Получатель:</strong> {{ item.full_name }} <span
                                v-if="item.identify">( {{
                                    item.identify
                                }}) </span></div>

                            <div class="col-12" v-if="item.sender_full_name"><strong>Отправитель:</strong>
                                {{ item.sender_full_name }} <span v-if="item.sender_info">( {{
                                        item.sender_info
                                    }}) </span></div>

                            <div class="col-12"><span class="badge bg-primary rounded-pill">{{ item.created_at }}</span>
                            </div>
                            <div class="col-12 mt-2"><p class="w-100">
                                {{ item.sms }}
                            </p></div>
                            <div class="col-12">
                                <p v-if="item.send_at">Прочитано в
                                    <span class="badge bg-info">{{ item.send_at }}</span>
                                </p>
                                <span class="badge bg-gray" v-else>Еще не получено</span>
                            </div>
                            <!--           <div class="col-12" v-if="!item.send_at">

                                <button
                                    class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center"
                                    @click="checkMessage(item.id)"
                                    type="submit" :disabled="loader">
                                    <span v-if="!loader">Отметить как прочитанное</span>
                                    <span v-if="loader"><img src="/img/loader.gif" class="loader-btn" alt=""></span>
                                </button>
                            </div>-->
                        </div>


                    </li>
                </ul>
                <p class="mt-2" v-if="messages.length==0">Сообщений нет по данному запросу</p>
                <div class="divider divider-center-icon border-light"><i class="bi bi-flower1"></i></div>
            </div>
        </div>


        <div class="card">
            <div class="card-body direction-rtl">
                <!-- Search Form Wrapper -->
                <div class="alert custom-alert-2 alert-dismissible fade  show"
                     v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                     v-if="message" role="alert">
                    <i class="bi bi-check-circle"></i>{{ message }}
                </div>

                <div class="search-form-wrapper">


                    <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>Ваше сообщение будет отправлено публично! Мы вывешиваем списки
                        с сообщениям
                        каждые два дня в центре выдачи гум. помощи! Сообщения будут видны всем! Рекомендуем оставлять
                        короткие сообщения с контактной информацией.
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <!-- Search Form -->
                    <form class="mb-3 pb-4 border-bottom" v-on:submit.prevent="sendMessage" ref="message">
                        <div class="form-group mb-2">
                            <label for="tname">Фамилия<span
                                style="color:red;">*</span></label>
                            <input class="form-control form-control-clicked" type="text" id="tname"
                                   placeholder="Иванов" v-model="form.tname" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="fname">Имя<span
                                style="color:red;">*</span></label>
                            <input class="form-control form-control-clicked" type="text" id="fname" placeholder="Иван"
                                   v-model="form.fname" required>

                        </div>

                        <div class="form-group mb-2">
                            <label for="sname">Отчество<span
                                style="color:red;">*</span></label>
                            <input class="form-control form-control-clicked" type="text" id="sname"
                                   placeholder="Иванович" v-model="form.sname" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="identify">Данные для более точной идентификации, например, номер
                                паспорта</label>
                            <textarea class="form-control" id="identify"
                                      placeholder="Дополнительная идентификация"
                                      maxlength="255"
                                      v-model="form.identify">
                            </textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="sms">Короткое сообщение {{ form.sms.length }}/255<span
                                style="color:red;">*</span></label>
                            <textarea class="form-control" id="sms"
                                      placeholder="Сообщение"
                                      maxlength="255"
                                      v-model="form.sms" required>
                            </textarea>
                        </div>


                        <div class="form-group mb-2">


                            <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                                    type="submit" :disabled="loader">
                        <span v-if="!loader">Отправить сообщене
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

                <a href="https://t.me/shelter_dpr_bot"
                   class="btn btn-link w-100 d-flex align-items-center justify-content-center">Перейти в бота
                </a>
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
        personId: {
            type: String,
            default: null
        },
        dataType: {
            type: String,
            default: 'haids'
        },
    },
    data() {
        return {
            loader: false,
            messageType: 0,
            message: null,
            need_search: false,
            messages: [],
            form: {
                sms: "",
                fname: null,
                sname: null,
                tname: null,
                identify: null,
                type: null,

                recaptcha: null
            }
        }
    },
    watch: {
        'form.recaptcha': function () {
            axios.post('/forms/send-message', this.form).then(resp => {

                this.message = "Успешно отправлено"
                this.messageType = 0;


                this.loader = false

                this.onCaptchaExpired()

                this.$refs.message.reset();

                setTimeout(() => {
                    window.location.href = "https://t.me/shelter_dpr_bot"
                }, 2000)


            }).catch(() => {
                this.message = "Ошибка отправки"
                this.messageType = 1;
                this.loader = false
            })
        },
    },
    mounted() {
        this.loadUserById()
    },
    methods: {
        onCaptchaVerified: function (recaptchaToken) {
            this.form.recaptcha = recaptchaToken
            this.validateCaptcha = true

        },
        onCaptchaExpired: function () {
            this.$refs.recaptcha.reset();
        },
        loadUserById() {
            if (this.personId == null)
                return

            axios.get("/forms/load-user-by-id?id=" + this.personId + "&type=" + this.dataType).then(resp => {
                this.form.fname = resp.data.fname
                this.form.sname = resp.data.sname
                this.form.tname = resp.data.tname
                this.form.identify = resp.data.passport
            })
        },
        sendMessage() {
            this.form.user_id = this.userId;
            this.form.person_id = this.personId;
            this.form.type = this.type;
            this.loader = true
            this.message = null
            this.messageType = 0;


            this.$refs.recaptcha.execute();

        },

        searchSubmit() {
            this.loader = true

            axios.post('/forms/search-message', {
                search: this.search
            }).then(resp => {
                this.messages = resp.data.data

                this.loader = false
                this.$refs.search.reset();

            }).catch(() => {
                this.loader = false
            })
        },
        checkMessage(id) {
            axios.post("/forms/messages/read", {
                id: id
            }).then(() => {
                this.loader = false
                this.searchSubmit();

            }).catch(() => {
                this.loader = false
            });
        },

    }
}
</script>
