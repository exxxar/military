<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Могу помочь с вещами</h4>
                <form v-on:submit.prevent="submit" ref="clothes">
                    <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>Все добавляемые заявки обрабатываются оператором. После обработки с вами свяжутся (от 1 часа до 24х часов в зависимости от загруженности)!
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="inputFullName">Ваше Ф.И.О.<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputFullName" type="text" placeholder="Иванов Иван Иванович"
                               v-model="form.full_name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputYourPhone">Ваш номер телефон для связи<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputYourPhone" type="text" placeholder="(071) 000-00-00"
                               v-mask="['(###) ###-##-##']" v-model="form.phone" required>
                    </div>


                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_delivery"
                               id="needHelpWithDelivery" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpWithDelivery">Нужна помощь с доставкой(перевозкой) </label>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Дополнительная информация о вас</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>

                    <div class="divider divider-center-icon border-success"><i class="bi bi-arrow-down"></i></div>

                    <div class="form-group">
                        <label class="form-label" for="inputAddressA">Откуда збрать вещи<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputAddressA" type="text" placeholder="г.Донецк, ул. Артема, 2"
                               v-model="form.from_address" required>
                    </div>


                    <div class="form-group">

                        <label class="form-label">Вещи\предметы на отдачу
                            ({{ form.clothes.length }}/{{ max_clothes }})</label>
                        <div v-for="(item,index) in form.clothes">
                            <a type="button" class="text-secondary small mb-2 w-100" v-if="index>0"
                               @click="remove(index)">Удалить</a>
                            <input class="form-control mb-2" :id="'clothes'+index" type="text" placeholder="Название одежы и размер"
                                    v-model="form.clothes[index]">
                        </div>

                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center mt-2"
                                @click="addNewClothes"
                                v-if="this.max_clothes>this.form.clothes.length"
                                type="button">Добавить еще
                        </button>
                    </div>


                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="message" role="alert">
                        <i class="bi bi-check-circle"></i>{{message}}
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


                    <a href="https://t.me/shelter_dpr_bot" class="btn btn-link w-100 d-flex align-items-center justify-content-center">Перейти в бота
                    </a>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { VueRecaptcha } from 'vue-recaptcha';

export default {
    components: {  'vue-recaptcha': VueRecaptcha, },
    props: {
        userId: {
            type: String,
            default: null
        },
    },
    data() {
        return {
            loader: false,
            messageType:0,
            message:null,
            max_clothes: 20,
            form: {
                full_name: null,
                phone: null,
                description: null,
                need_delivery: false,
                from_address:null,
                clothes:[""],
                user_id: null,
                recaptcha: null,

            }
        }
    },
    watch: {
        'form.recaptcha': function () {
            axios.post('/forms/help-clothes', this.form).then(resp => {

                this.message = "Заявка успешно добавлена!"
                this.messageType = 0;

                this.loader = false
                this.$refs.clothes.reset();

                this.onCaptchaExpired()

                window.location.href = "https://t.me/shelter_dpr_bot";
                /*   setTimeout(() => {
                       window.location.reload()
                   }, 2000)*/
            }).catch(()=>{
                this.message = "Ошибка добавления заявки!"
                this.messageType = 1;
            })
        }
    },
    methods: {

        onCaptchaVerified: function (recaptchaToken) {
            this.form.recaptcha = recaptchaToken
            this.validateCaptcha = true

        },
        onCaptchaExpired: function () {
            this.$refs.recaptcha.reset();
        },
        submit() {
            this.form.user_id = this.userId;
            this.loader = true
            this.message = null
            this.messageType = 0;

            this.$refs.recaptcha.execute();
        },

        addNewClothes() {
            let find = this.form.clothes.filter(item => item.trim() === "").length > 0;

            if (!find && this.max_clothes > this.form.clothes.length)
                this.form.clothes.push("");
        },
        remove(index) {
            this.form.clothes.splice(index, 1);
        },


    }
}
</script>
