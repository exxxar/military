<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Запрос на помощь перевозки \ доставки</h4>
                <form v-on:submit.prevent="submit" ref="delivery">
                    <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>Все добваляемые заявки обрабатываются оператором. После обрботки с вами свяжутся (от 1 часа до 24х часов в зависимости от загруженности)!
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="inputFullName">Ваше Ф.И.О.<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputFullName" type="text" placeholder="Иванов Иван Иванович"
                               v-model="form.full_name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputYourPhone">Ваш номер телефон<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputYourPhone" type="text" placeholder="(071) 000-00-00"
                               v-mask="['(###) ###-##-##']" v-model="form.phone" required>
                    </div>


                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-danger"
                               v-model="form.cannotPay"
                               id="cannotPay" type="checkbox" checked="">
                        <label class="form-check-label" for="cannotPay">В тяжелом материальном состоянии</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_arraive"
                               id="needArrive" type="checkbox" checked="">
                        <label class="form-check-label" for="needArrive">Нужна поездка</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_delivery"
                               id="needHelpWithDelivery" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpWithDelivery">Нужна помощь с доставкой(перевозкой) </label>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Дополнительня информация о вас</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>

                    <div class="divider divider-center-icon border-success"><i class="bi bi-arrow-down"></i></div>

                    <div class="form-group">
                        <label class="form-label" for="inputAddressA">Откуда едем<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputAddressA" type="text" placeholder="г.Донецк, ул. Артема, 2"
                               v-model="form.from_address" required>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="inputAddressB">Куда едем<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputAddressB" type="text" placeholder="г.Донецк, ул. Артема, 100"
                               v-model="form.to_address" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputDate">Дата поездки<span
                            style="color:red;">*</span></label>
                        <input class="form-control form-control-clicked" id="inputDate"
                               v-model="form.arrive_date" required
                               type="datetime-local">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="range-people">Сколько людей с вами?</label>
                        <div class="range-with-value d-flex align-items-center">
                            <input class="form-range" id="range-people" type="range" min="0" max="7" value="1"
                                   step="1" v-model="form.people_count">
                            <button class="btn btn-primary btn-sm ms-3">{{ form.people_count }}</button>
                        </div>
                    </div>


                    <div class="form-group mt-3 mb-3">
                        <div class="rating-card-three text-center">
                            <h6 class="mb-3">На сколько это критично для вас?</h6>
                            <div class="stars">
                                <input class="stars-checkbox" id="first-star" type="radio" name="star" value="5"
                                       v-model="form.rating">
                                <label class="stars-star" for="first-star">
                                    <svg class="star-icon" id="star1" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                         xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                </label>
                                <input class="stars-checkbox" id="second-star" type="radio" name="star" value="4"
                                       v-model="form.rating">
                                <label class="stars-star" for="second-star">
                                    <svg class="star-icon" id="star2" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                         xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                </label>
                                <input class="stars-checkbox" id="third-star" type="radio" name="star" value="3"
                                       v-model="form.rating">
                                <label class="stars-star" for="third-star">
                                    <svg class="star-icon" id="star3" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                         xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                </label>
                                <input class="stars-checkbox" id="fourth-star" type="radio" name="star" value="2"
                                       v-model="form.rating">
                                <label class="stars-star" for="fourth-star">
                                    <svg class="star-icon" id="star4" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                         xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                </label>
                                <input class="stars-checkbox" id="fifth-star" type="radio" name="star" value="1"
                                       v-model="form.rating">
                                <label class="stars-star" for="fifth-star">
                                    <svg class="star-icon" id="star5" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                         xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                </label>
                            </div>
                        </div>
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
    watch: {
        'form.recaptcha': function () {
            axios.post('/forms/help-delivery', this.form).then(resp => {

                this.message = "Заявка успешно добавлена!"
                this.messageType = 0;

                this.loader = false
                this.$refs.delivery.reset();

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
    data() {
        return {
            loader: false,
            messageType:0,
            message:null,
            max_food_and_goods: 10,
            max_medical_goods: 10,
            form: {
                full_name: null,
                phone: null,
                people_count: 1,
                description: null,
                need_arrive: false,
                need_delivery: false,
                from_address:null,
                to_address:null,
                arrive_date:null,

                cannotPay: true,
                rating:1,

                user_id: null,
                recaptcha: null,
            }
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


    }
}
</script>
