<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Добавление нового убежища</h4>
                <form v-on:submit.prevent="submit" ref="newShelter">
                    <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>Все добавляемые убежища проверяются модератором перед утверждением!
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <label class="form-label" for="range-with-value">Примерная вместимость</label>
                        <div class="range-with-value d-flex align-items-center">
                            <input class="form-range" id="range-with-value" type="range" min="0" max="500" value="10"
                                   step="1" v-model="form.capacity">
                            <button class="btn btn-primary btn-sm ms-3">{{ form.capacity }}</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="balanceHolderInput">У кого на балансе</label>
                        <input class="form-control" id="balanceHolderInput" type="text"
                               placeholder="ООО'Вода Донбасса'" v-model="form.balance_holder">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="responsiblePersonInput">Отвественный</label>
                        <input class="form-control" id="responsiblePersonInput" type="text" placeholder="Ивнова В.В."
                               v-model="form.responsible_person">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="inputYourPhone">Ваш номер телефон<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputYourPhone" type="text" placeholder="(071) 000-00-00"
                               v-mask="['(###) ###-##-##']" v-model="form.phone" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="shelterStatusSelect">Выберите статус убежища</label>
                        <select class="form-select form-select-lg" id="shelterStatusSelect" name="shelterStatusSelect"
                                v-model="form.status"
                                aria-label="Выбор состояния убежища">
                            <option value="0" selected="">Не проверено</option>
                            <option value="1">Действующее</option>
                            <option value="2">Разрушенное</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="qualityStateSelect">Выберите технчиеское состояние
                            убежища</label>
                        <select class="form-select form-select-lg" id="qualityStateSelect" name="qualityStateSelect"
                                v-model="form.quality"
                                aria-label="Выберите технчиеское состояние убежища">
                            <option value="0" selected="">Неизвестное состояние</option>
                            <option value="1">В нормальном состоянии</option>
                            <option value="2">Неприемлимое состояние</option>
                            <option value="3">Подтопленное</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="rating-card-three text-center">
                            <h6 class="mb-3">Оценка качества убежища</h6>
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
                    <div class="form-group">
                        <label class="form-label" for="shelterTypeSelect">Выберите тип убежища</label>
                        <select class="form-select form-select-lg" id="shelterTypeSelect" name="shelterTypeSelect"
                                value="1" v-model="form.type"
                                aria-label="Выберите тип убежища">
                            <option value="0" selected="">Убежище</option>
                            <option value="2">Подвальное помещение</option>
                            <option value="1">Военный дот</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="facility">Удобства
                            ({{ form.facility.length }}/{{ maxFacilities }})</label>
                        <input class="form-control mb-2" id="facility" type="text" placeholder="Название удобств"
                               v-for="(item,index) in form.facility" v-model="form.facility[index]">
                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center mt-2"
                                @click="addNewFacility"
                                v-if="this.maxFacilities>this.form.facility.length"
                                type="button">Указать еще удобство
                        </button>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Введие детали (номер телефона, др. детали)</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>

                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="message" role="alert">
                        <i class="bi bi-check-circle"></i>{{message}}
                          </div>

                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                            type="submit">Добавить
                        <svg class="bi bi-arrow-right-short" width="24" height="24" viewBox="0 0 16 16"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>
                    </button>

                    <a href="https://t.me/shelter_dpr_bot" class="btn btn-link w-100 d-flex align-items-center justify-content-center">Перейти в бота
                    </a>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            maxFacilities: 10,
            messageType:0,
            message:null,
            form: {
                city: null,
                region: null,
                address: null,
                lat: null,
                lon: null,
                balance_holder: null,
                responsible_person: null,
                capacity: 10,
                description: null,
                status: 0,
                quality: 0,
                type: 0,
                facility: [""],
                rating: 1,
                phone: null
            }
        }
    },
    methods: {
        submit() {
            this.message = null
            this.messageType = 0;
            axios.post('/api/shelters/new-shelter', this.form).then(resp => {
                this.$refs.newShelter.reset();
                this.message = "Убежище успешно добавлено!"
                this.messageType = 0;
            }).catch(()=>{
                this.message = "Ошибка добавления убежища!"
                this.messageType = 1;
            })
        },
        addNewFacility() {
            let find = this.form.facility.filter(item => item.trim() === "").length > 0;

            if (!find && this.maxFacilities > this.form.facility.length)
                this.form.facility.push("");
        }
    }
}
</script>
