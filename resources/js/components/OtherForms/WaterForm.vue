<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Запрос на доставку воды</h4>
                <form v-on:submit.prevent="submit" ref="water">
                    <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>Все добавляемые заявки обрабатываются оператором. После
                        обработки с вами свяжутся (от 1 часа до 24х часов в зависимости от загруженности)!
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
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


                    <div class="form-group">
                        <label class="form-label" for="description">Дополнительня информация о вас</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="range-people">Для скольки людей?</label>
                        <div class="range-with-value d-flex align-items-center">
                            <input class="form-range" id="range-people" type="range" min="0" max="10" value="2"
                                   step="1" v-model="form.people_count">
                            <button class="btn btn-primary btn-sm ms-3">{{ form.people_count }}</button>
                        </div>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_technical_water"
                               id="needTechnicalWater" type="checkbox">
                        <label class="form-check-label" for="needTechnicalWater">Нужна техническая вода</label>
                    </div>

                    <div class="form-group" v-if="form.need_technical_water">
                        <label class="form-label" for="range-technical-water">Объем технической воды, литров</label>
                        <div class="range-with-value d-flex align-items-center">
                            <input class="form-range" id="range-technical-water" type="range" min="0" max="100" value="2"
                                   step="1" v-model="form.technical_water">
                            <button class="btn btn-primary btn-sm ms-3">{{ form.technical_water }}</button>
                        </div>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_drinking_water"
                               id="needDrinkingWater" type="checkbox">
                        <label class="form-check-label" for="needDrinkingWater">Нужна питьевая вода</label>
                    </div>

                    <div class="form-group" v-if="form.need_drinking_water">
                        <label class="form-label" for="range-drinking-water">Объем питьевой воды, литров</label>
                        <div class="range-with-value d-flex align-items-center">
                            <input class="form-range" id="range-drinking-water" type="range" min="0" max="100" value="2"
                                   step="1" v-model="form.drinking_water">
                            <button class="btn btn-primary btn-sm ms-3">{{ form.drinking_water }}</button>
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
                        <i class="bi bi-check-circle"></i>{{ message }}
                    </div>

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
export default {
    props: {
        userId: {
            type: String,
            default: null
        },
    },
    data() {
        return {
            loader: false,
            messageType: 0,
            message: null,

            form: {
                full_name: null,
                people_count: 1,
                phone: null,
                description: null,
                user_id: null,
                rating: 1,
                need_technical_water:false,
                need_drinking_water:false,
                drinking_water: 1,
                technical_water: 1,


            }
        }
    },
    methods: {
        submit() {
            this.form.user_id = this.userId;
            this.loader = true
            this.message = null
            this.messageType = 0;
            axios.post('/forms/help-water', this.form).then(resp => {

                this.message = "Заявка успешно добавлена!"
                this.messageType = 0;

                this.$refs.water.reset();
                this.loader = false

                window.location.href = "https://t.me/shelter_dpr_bot";
                /*   setTimeout(() => {
                       window.location.reload()
                   }, 2000)*/
            }).catch(() => {
                this.message = "Ошибка добавления заявки!"
                this.messageType = 1;
                this.loader = false
            })
        },
        addNewLocations() {
            let find = this.form.locations.filter(item => item.title.trim() === "").length > 0;

            if (!find && this.max_locations > this.form.locations.length)
                this.form.locations.push({
                    title: "",
                    city: null,
                    address: null,
                    phone: null,
                    description: null,
                    volume: 10,
                    time_from: null,
                    time_to: null,

                });
        },
        remove(index) {
            this.form.locations.splice(index, 1);
            ;
        }

    }
}
</script>
