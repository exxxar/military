<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Запрос на помощь</h4>
                <form v-on:submit.prevent="submit" ref="helpForm">
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
                        <label class="form-label" for="inputAge">Ваш возраст<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputAge" type="number" placeholder="18"
                               v-model="form.age" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputYourPhone">Ваш номер телефон<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputYourPhone" type="text" placeholder="(071) 000-00-00"
                               v-mask="['(###) ###-##-##']" v-model="form.phone" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="range-people">Сколько людей с вами?</label>
                        <div class="range-with-value d-flex align-items-center">
                            <input class="form-range" id="range-people" type="range" min="0" max="10" value="2"
                                   step="1" v-model="form.people_count">
                            <button class="btn btn-primary btn-sm ms-3">{{ form.people_count }}</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Дополнительня информация о вас</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>

                    <div class="divider divider-center-icon border-success"><i class="bi bi-arrow-down"></i></div>



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

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_goods"
                               id="needHelpWithGoods" type="checkbox">
                        <label class="form-check-label" for="needHelpWithGoods">Нужна помощь с продуктами</label>
                    </div>

                    <div v-if="form.need_goods" class="mt-2 mb-2">

                        <h6>Сформируйте продуктовый список ({{form.food_and_goods.length}}/{{max_food_and_goods}})</h6>
                        <div class="row" v-for="(item,index) in form.food_and_goods">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="foodTitle">Название продукта</label>
                                    <input class="form-control" id="foodTitle" type="text" placeholder="Молоко"
                                           v-model="form.food_and_goods[index].title" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="foodValue">Кол-во</label>
                                    <input class="form-control" id="foodValue" type="number" placeholder=""
                                           v-model="form.food_and_goods[index].value" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" >
                                    <label class="form-label" for="measure">ед.
                                        изм.</label>
                                    <select class="form-select form-select-md" id="measure" name="qualityStateSelect"
                                            v-model="form.food_and_goods[index].measure"
                                            aria-label="Выберите единицы измерения">
                                        <option value="шт" selected="">шт.</option>
                                        <option value="пакет">пакет</option>
                                        <option value="грамм">грамм</option>
                                        <option value="кг">кг</option>
                                        <option value="упаковок">упаковок</option>
                                        <option value="пачек">пачек</option>
                                        <option value="коробок">коробок</option>
                                        <option value="литров">литров</option>
                                        <option value="ед">ед.</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center"
                                v-if="this.max_food_and_goods > this.form.food_and_goods.length"
                                @click="addNewFoodAndGoods"
                                type="button">Добавить еще
                        </button>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_psyhologist"
                               id="needHelpByPsyhologist" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpByPsyhologist">Нужна помощь психолога</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_home"
                               id="needHelpWithHome" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpWithHome">Нужно жильё или временное размещение</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_evacuation"
                               id="needHelpEvacuation" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpEvacuation">Нужна помощь с эвакуацией</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_animal"
                               id="needHelpWithAnimals" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpWithAnimals">Нужна помощь с животными (у меня есть животные)</label>
                    </div>

                    <div class="form-group" v-if="form.need_animal">
                        <label class="form-label" for="inputAnimals">Укажите животных (перечислите)</label>
                        <input class="form-control" id="inputAnimals" type="text" placeholder="Кот, собака, 2 попугайчика"
                               v-model="form.animals">
                    </div>


                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_clothes"
                               id="needHelpWithCloth" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpWithCloth">Нужна помощь с одеждой</label>
                    </div>

                    <div class="form-group" v-if="form.need_clothes">
                        <label class="form-label" for="facility">Необходимая одежда
                            ({{ form.clothes.length }}/{{ max_clothes }})</label>
                        <input class="form-control mb-2" id="facility" type="text" placeholder="Название одежы и размер"
                               v-for="(item,index) in form.clothes" v-model="form.clothes[index]">
                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center mt-2"
                                @click="addNewClothes"
                                v-if="this.max_clothes>this.form.clothes.length"
                                type="button">Добавить еще
                        </button>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success" i
                               v-model="form.need_medical_goods"
                               id="needHelpWithMedicalGoods" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpWithMedicalGoods">Нужна помощь с медикаментами</label>
                    </div>

                    <div v-if="form.need_medical_goods" class="mt-2 mb-2">

                        <h6>Сформируйте список мед.товаров ({{form.medical_goods.length}}/{{max_medical_goods}})</h6>
                        <div class="row" v-for="(item,index) in form.medical_goods">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="medicalTitle">Название мед.изделия \ лекарства</label>
                                    <input class="form-control" id="medicalTitle" type="text" placeholder="Аспирин \ бинт \ шприцы"
                                           v-model="form.medical_goods[index].title" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="medicalValue">Кол-во</label>
                                    <input class="form-control" id="medicalValue" type="number" placeholder=""
                                           v-model="form.medical_goods[index].value" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" >
                                    <label class="form-label" for="medicalMeasure">ед.
                                        изм.</label>
                                    <select class="form-select form-select-md" id="medicalMeasure" name="qualityStateSelect"
                                            v-model="form.medical_goods[index].measure"
                                            aria-label="Выберите единицы измерения">
                                        <option value="шт" selected="">шт.</option>
                                        <option value="пакет">пакет</option>
                                        <option value="грамм">грамм</option>
                                        <option value="пластинок">пластинок</option>
                                        <option value="упаковок">упаковок</option>
                                        <option value="пачек">пачек</option>
                                        <option value="коробок">коробок</option>
                                        <option value="литров">литров</option>
                                        <option value="ед">ед.</option>
                                        <option value="ампул">ампул</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center"
                                v-if="this.max_medical_goods > this.form.medical_goods.length"
                                @click="addNewMedicalGoods"
                                type="button">Добавить еще
                        </button>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_doctor"
                               id="needHelpByDoctor" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpByDoctor">Нужна помощь или консультация врача</label>
                    </div>

                    <div class="form-group" v-if="form.need_doctor">
                        <label class="form-label" for="descriptionForDoctor">Краткое описание ситуации</label>
                        <textarea class="form-control" id="descriptionForDoctor" name="description" cols="3" rows="5"
                                  v-model="form.description_for_doctor"
                                  placeholder="Описание проблемы"></textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_debris_removal"
                               id="needHelpWithDebrisRemoval" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpWithDebrisRemoval">Нужна помощь с разбором завалов</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_arrive"
                               id="needHelpWithArrive" type="checkbox" checked="">
                        <label class="form-check-label" for="needHelpWithArrive">Нужна помощь с проездом или доставкой</label>
                    </div>

                    <div class="divider divider-center-icon mt-3 border-success"><i class="bi bi-gear"></i></div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-danger"
                               v-model="form.cannotPay"
                               id="cannotPay" type="checkbox" checked="">
                        <label class="form-check-label" for="cannotPay">В тяжелом материальном состоянии</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_search_people"
                               id="needHelpWithSearchPeople" type="checkbox">
                        <label class="form-check-label" for="needHelpWithSearchPeople">Нужна помощь в поиске родственников</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_coal"
                               id="needCoal" type="checkbox">
                        <label class="form-check-label" for="needCoal">Нужна помощь с углём</label>
                    </div>

                    <div class="form-group" v-if="form.need_coal">
                        <label class="form-label" for="range-technical-water">Объем необходимого угля, тонн</label>
                        <div class="range-with-value d-flex align-items-center">
                            <input class="form-range" id="range-coal" type="range" min="0" max="10" value="2"
                                   step="1" v-model="form.coal">
                            <button class="btn btn-primary btn-sm ms-3">{{ form.coal }}</button>
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
            axios.post('/forms/need-help', this.form).then(resp => {
                this.$refs.helpForm.reset();
                this.message = "Заявка успешно добавлена!"
                this.messageType = 0;
                this.loader = false

                this.onCaptchaExpired()

                window.location.href = "https://t.me/shelter_dpr_bot";
                /*   setTimeout(() => {
                       window.location.reload()
                   }, 2000)*/

            }).catch(()=>{
                this.message = "Ошибка добавления зявки!"
                this.messageType = 1;
                this.loader = false
            })
        },
    },
    data() {
        return {
            messageType:0,
            message:null,
            max_food_and_goods: 10,
            max_medical_goods: 10,
            max_clothes: 20,
            loader:false,
            form: {
                full_name: null,
                age: 18,
                phone: null,
                people_count: 2,
                description: null,
                need_goods: false,
                need_psyhologist: false,
                need_home: false,
                need_animal: false,
                need_clothes: false,
                need_evacuation: false,
                need_medical_goods: false,
                need_debris_removal: false,
                need_arrive: false,
                need_doctor: false,
                cannotPay: true,
                need_search_people: false,
                need_coal: false,
                coal: 1,

                need_technical_water:false,
                need_drinking_water:false,
                drinking_water: 1,
                technical_water: 1,

                animals:null,
                rating:1,
                description_for_doctor: null,
                food_and_goods:[{
                    title:"",
                    value:0,
                    measure:"шт",
                }],
                medical_goods:[
                    {
                        title:"",
                        value:0,
                        measure:"шт",
                    }
                ],
                clothes:[""],
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
            this.message = null
            this.messageType = 0;
            this.form.user_id = this.userId;
            this.loader = true

            this.$refs.recaptcha.execute();

        },
        addNewMedicalGoods() {
            let find = this.form.medical_goods.filter(item => item.title.trim() === "").length > 0;

            if (!find && this.max_medical_goods > this.form.medical_goods.length)
                this.form.medical_goods.push({
                    title:"",
                    value:0,
                    measure:"шт",
                });
        },
        addNewFoodAndGoods() {
            let find = this.form.food_and_goods.filter(item => item.title.trim() === "").length > 0;

            if (!find && this.max_food_and_goods > this.form.food_and_goods.length)
                this.form.food_and_goods.push({
                    title:"",
                    value:0,
                    measure:"шт",
                });
        },
        addNewClothes() {
            let find = this.form.clothes.filter(item => item.trim() === "").length > 0;

            if (!find && this.max_clothes > this.form.clothes.length)
                this.form.clothes.push("");
        }
    }
}
</script>
