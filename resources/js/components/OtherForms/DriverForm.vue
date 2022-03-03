<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Могу подвезти \ доставить</h4>
                <form v-on:submit.prevent="submit" ref="newShelter">
                    <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>Все добваляемые заявки обрабатываются оператором. После
                        обрботки с вами свяжутся (от 1 часа до 24х часов в зависимости от загруженности)!
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
                        <label class="form-label" for="inputCity">Город расположения<span
                            style="color:red;">*</span></label>
                        <input class="form-control" id="inputCity" type="text" placeholder="г. Донецк"
                               v-model="form.city" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="inputRegion">Район расположения</label>
                        <input class="form-control" id="inputRegion" type="text" placeholder="Куйбышевский район"
                               v-model="form.region" required>
                    </div>

                    <div class="form-check form-switch ">
                        <input class="form-check-input form-check-success"
                               v-model="form.have_a_car"
                               id="haveCar" type="checkbox">
                        <label class="form-check-label" for="haveCar">Есть своё авто</label>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Категория прав</label>
                        <div class="list-group">
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="М">М — мопеды и легкие квадроциклы
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="А" checked="">А — мотоциклы
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="В">В — легковые автомобили (полной массой до 3,5 т, пассажирских мест — не
                                более 8)
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="ВЕ">ВЕ — легковые автомобили с прицепом массой более 750 кг
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="С">С — грузовики (с полной массой более 7,5 т)
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="СЕ">СЕ — грузовики с прицепом массой более 750 кг
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="D">D — автобусы (пассажирских месте — более 8)
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="DE">DE — автобусы с прицепом массой более 750 кг
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="TM">TM — трамваи
                            </label>
                            <label class="list-group-item">
                                <input class="form-check-input me-2" type="checkbox" name="driverLicenseCategory" v-model="form.license_categories" value="TB">TB — троллейбусы
                            </label>

                        </div>


                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Дополнительня информация о вас</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>




                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="message" role="alert">
                        <i class="bi bi-check-circle"></i>{{ message }}
                    </div>

                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                            type="submit">Отправить запрос
                        <svg class="bi bi-arrow-right-short" width="24" height="24" viewBox="0 0 16 16"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>
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
    data() {
        return {
            messageType: 0,
            message: null,

            form: {
                full_name: null,
                age: 18,
                phone: null,
                city: null,
                region: null,
                description: null,
                license_categories: [],
                have_a_car: true,


            }
        }
    },
    methods: {
        submit() {
            console.log(this.form.license_categories)
            this.message = null
            this.messageType = 0;
            axios.post('/api/shelters/new-shelter', this.form).then(resp => {
                this.$refs.newShelter.reset();
                this.message = "Убежище успешно добавлено!"
                this.messageType = 0;
            }).catch(() => {
                this.message = "Ошибка добавления убежища!"
                this.messageType = 1;
            })
        },

        addNewSkills() {
            let find = this.form.skills.filter(item => item.title.trim() === "").length > 0;

            if (!find && this.max_skills > this.form.skills.length)
                this.form.skills.push({
                    title: "",
                    rating: 1
                });
        }
    }
}
</script>
