<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Могу обеспечить питанием людей</h4>
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
                        <h6>Сформируйте список локаций ({{ form.locations.length }}/{{ max_locations }})</h6>
                        <div v-for="(item,index) in form.locations">
                              <div class="form-group">
                                <label class="form-label" :for="'title'+index">Название заведения<span
                                    style="color:red;">*</span></label>
                                <input class="form-control" :id="'title'+index" type="text" placeholder="кафе 'Бочка'"
                                       v-model="form.locations[index].title" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="'city'+index">Город расположения<span
                                    style="color:red;">*</span></label>
                                <input class="form-control" :id="'city'+index" type="text" placeholder="город Донецк"
                                       v-model="form.locations[index].city" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="'address'+index">Адрес заведения<span
                                    style="color:red;">*</span></label>
                                <input class="form-control" :id="'address'+index" type="text"
                                       placeholder="ул. Артема, 2а"
                                       v-model="form.locations[index].address" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="'range-people'+index">Вместимость \ охват людей</label>
                                <div class="range-with-value d-flex align-items-center">
                                    <input class="form-range" :id="'range-people'+index" type="range" min="0" max="500"
                                           value="10"
                                           step="1" v-model="form.locations[index].volume">
                                    <button class="btn btn-primary btn-sm ms-3">{{
                                            form.locations[index].volume
                                        }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="'description'+index">Дополнительня информация о
                                    вас</label>
                                <textarea class="form-control" :id="'description'+index" name="description" cols="3"
                                          rows="5"
                                          v-model="form.locations[index].description"
                                          placeholder="Описание"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" :for="'timer-start'+index">Время начала</label>
                                        <input class="form-control form-control-clicked"
                                               v-model="form.locations[index].time_from"
                                               :id="'timer-start'+index" type="time">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" :for="'timer-end'+index">Время окончания</label>
                                        <input class="form-control form-control-clicked"
                                               v-model="form.locations[index].time_to"
                                               :id="'timer-end'+index" type="time">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mb-2 w-100" v-if="index>0" @click="remove(index)">Удалить</button>

                            <div class="divider divider-dotted border-success"></div>

                        </div>


                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center"
                                v-if="this.max_locations > this.form.locations.length"
                                @click="addNewLocations"
                                type="button">Добавить еще локацию
                        </button>
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
            max_requires: 30,
            form: {
                full_name: null,
                phone: null,
                description: null,
                city: null,
                address: null,

                time_from: null,
                time_to: null,


                requires: [""],

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
            }).catch(() => {
                this.message = "Ошибка добавления убежища!"
                this.messageType = 1;
            })
        },
        addNewRequired() {
            let find = this.form.requires.filter(item => item.trim() === "").length > 0;

            if (!find && this.max_requires > this.form.requires.length)
                this.form.requires.push("");
        },
        remove(index) {
            this.form.requires.splice(index, 1);;
        }

    }
}
</script>
