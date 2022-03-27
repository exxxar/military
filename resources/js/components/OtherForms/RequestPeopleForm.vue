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
                    <p class="mb-2 fz-12">Найдено {{ peoples.length }} результатов поиск</p>
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
                        {{index+1}}# {{ item.tname }} {{ item.fname }} {{ item.sname }}
                    </h6><a class="text-truncate mb-2 d-block fz-12 text-decoration-underline"
                            :href="'/forms/pdf/download?uuid='+item.uuid" target="_blank">Открыть pdf документ</a>
                </div>

            </div>
        </div>
    </div>
</template>
<script>

import FileDownload from "js-file-download";

export default {
    data() {
        return {
            loader: false,
            messageType: 0,
            message: null,

            peoples: [],
            form: {
                fname: null,
                sname: null,
                tname: null,
                uuid: null,

            }
        }
    },
    methods: {

        search() {
            this.form.user_id = this.userId;
            this.loader = true
            this.message = null
            this.messageType = 0;


            /*  this.$refs.recaptcha.execute();*/

            axios.post('/forms/find-people', this.form).then(resp => {

                this.message = "Поиск прошел успешно"
                this.messageType = 0;


                this.loader = false

                this.peoples = resp.data.data


            }).catch(() => {
                this.message = "Ошибка поиска"
                this.messageType = 1;
                this.loader = false
            })


        },


    }
}
</script>
