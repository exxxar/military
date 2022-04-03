<template>
    <div class="container">
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
                        <i class="bi bi-check-circle"></i>Ваше сообщение будет отправлено публично! Мы вывешиваем списки с сообщениям
                        каждые два дня в центре выдачи гум. помощи! Сообщения будут видны всем! Рекомендуем оставлять короткие сообщения с контактной информацией.
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <!-- Search Form -->
                    <form class="mb-3 pb-4 border-bottom" v-on:submit.prevent="sendMessage">
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
                            <label for="identify">Данные для более точной идентификации, например, номер паспорта</label>
                            <textarea class="form-control" id="identify"
                                      placeholder="Дополнительная идентификация"
                                      maxlength="255"
                                      v-model="form.identity" required>
                            </textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="sms">Короткое сообщение {{form.sms.length}}/255<span
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
        type: {
            type: String,
            default: 0
        },
    },
    data() {
        return {
            loader: false,
            messageType: 0,
            message: null,

            form: {
                sms: "",
                fname: null,
                sname: null,
                tname: null,
                identity: null,

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

                setTimeout(()=>{
                    window.location.href = "https://t.me/shelter_dpr_bot"
                },2000)


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
            if (this.userId == null)
                return

            axios.get("/forms/load-user-by-id?id=" + this.userId).then(resp=>{
                this.form.fname = resp.data.fname
                this.form.sname = resp.data.sname
                this.form.tname = resp.data.tname
                this.form.identity = resp.data.passport
            })
        },
        sendMessage() {
            this.form.user_id = this.userId;
            this.loader = true
            this.message = null
            this.messageType = 0;


            this.$refs.recaptcha.execute();

        },


    }
}
</script>
