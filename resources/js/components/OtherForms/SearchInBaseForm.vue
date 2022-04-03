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
                    <p class="mb-2 fz-12">Найдено {{ peoples.length }} результатов поиска</p>
                    <small>В поиск выдает последние 10 записей</small>


                    <!-- Search Form -->
                    <form class="mb-3 pb-4 border-bottom" v-on:submit.prevent="search">
                        <div class="form-group mb-2">
                            <label for="tname">Фамилия</label>
                            <input class="form-control form-control-clicked" type="search" id="tname"
                                   placeholder="Иванов" v-model="form.tname">
                        </div>

                        <div class="form-group mb-2">
                            <label for="fname">Имя</label>
                            <input class="form-control form-control-clicked" type="search" id="fname" placeholder="Иван"
                                   v-model="form.fname">

                        </div>

                        <div class="form-group mb-2">
                            <label for="sname">Отчество</label>
                            <input class="form-control form-control-clicked" type="search" id="sname"
                                   placeholder="Иванович" v-model="form.sname">
                        </div>
                        <hr>
                        <div class="form-group mb-2">
                            <label for="uuid">Уникальный идентификатор</label>
                            <input class="form-control form-control-clicked" type="search" id="uuid" placeholder="UUID"
                                   v-model="form.uuid">
                        </div>

                        <div class="form-group mb-2">


                            <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                                    type="submit" :disabled="loader">
                        <span v-if="!loader">Найти
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
                <!-- Single Search Result -->
                <div v-if="peoples.length>0" class="single-search-result mb-3 border-bottom pb-3"
                     v-for="(item, index) in peoples">
                    <h6 class="text-truncate mb-1">
                        {{ index + 1 }}# {{ item.tname }} {{ item.fname }} {{ item.sname }}
                    </h6>
                    <p>(добавлен {{ item.created_at }})</p>
                    <span class="badge bg-primary" v-if="item.type==0">заявка на поиск</span>
                    <span class="badge bg-success" v-if="item.type==1">вышел на связь</span>
                    <a class="text-truncate mb-2 d-block fz-12 text-decoration-underline"
                       :href="'/forms/pdf/download?uuid='+item.uuid" target="_blank">Открыть pdf документ</a>
                    <a :href="'/forms/send-message/'+item.id+'?uid='+userId+'&by=people'" target="_blank">Оставить
                        записку</a>
                </div>

                <ul class="list-group" v-if="history.length>0">
                    <h3>Информация по выдаче гумманитарной помощи</h3>
                    <small>В поиск выдает последние 10 записей</small>


                    <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>В данном блоке отображаются только те люди, которые вышли на
                        сязь и получили гум. помощь (и которым оказана помощь вообще).
                        Для свяни с ними им можно отправить короткое текстовое сообщение.
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <li class="list-group-item d-flex align-items-center justify-content-between"
                        :key="index"
                        @click="fill(item)"
                        v-for="(item, index) in history"
                    >
                        {{ item.full_name }} <a :href="'/forms/send-message/'+item.id+'?uid='+userId" target="_blank">Оставить
                        записку</a><span class="badge bg-primary rounded-pill">{{ item.issue_at }}</span>
                    </li>
                </ul>

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
        }
    }
    ,
    data() {
        return {
            loader: false,
            messageType: 0,
            message: null,

            peoples: [],
            history: [],
            form: {
                fname: null,
                sname: null,
                tname: null,
                uuid: null,

                recaptcha: null
            }
        }
    },
    watch: {
        'form.recaptcha': function () {
            axios.post('/forms/search-in-base', this.form).then(resp => {

                this.message = "Поиск прошел успешно"
                this.messageType = 0;


                this.loader = false

                this.peoples = resp.data.peoples.data
                this.history = resp.data.aids.data

                this.onCaptchaExpired()


            }).catch(() => {
                this.message = "Ошибка поиска"
                this.messageType = 1;
                this.loader = false
            })
        },
    },
    methods: {
        onCaptchaVerified: function (recaptchaToken) {
            this.form.recaptcha = recaptchaToken
            this.validateCaptcha = true

        },
        onCaptchaExpired: function () {
            this.$refs.recaptcha.reset();
        },
        search() {
            this.form.user_id = this.userId;
            this.loader = true
            this.message = null
            this.messageType = 0;


            this.$refs.recaptcha.execute();


        },


    }
}
</script>
