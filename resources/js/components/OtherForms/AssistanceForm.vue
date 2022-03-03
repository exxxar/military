<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Могу предложить свою помощь</h4>
                <form v-on:submit.prevent="submit" ref="newShelter">
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
                        <label class="form-label" for="description">Дополнительня информация о вас</label>
                        <textarea class="form-control" id="description" name="description" cols="3" rows="5"
                                  v-model="form.description"
                                  placeholder="Описание"></textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input form-check-success"
                               v-model="form.need_transfer"
                               id="needTransfer" type="checkbox">
                        <label class="form-check-label" for="needTransfer">Понадобится трансфер</label>
                    </div>

                    <div class="divider divider-center-icon border-success"><i class="bi bi-arrow-down"></i></div>



                    <div class="form-group">

                        <h6>Сформируйте список ваших навыков ({{form.skills.length}}/{{max_skills}})</h6>
                        <div class="row" v-for="(item,index) in form.skills">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="foodTitle">Название навыка</label>
                                    <input class="form-control" id="foodTitle" type="text" placeholder="Сварщик, 1 разряд"
                                           v-model="form.skills[index].title" required>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="rating-card-three text-center">
                                    <h6 class="mb-3">Оцените ваш профессиональный навык</h6>
                                    <div class="stars">
                                        <input class="stars-checkbox" :id="'first-star'+index" type="radio" :name="'star'+index" value="5"
                                               v-model="form.skills[index].rating">
                                        <label class="stars-star" :for="'first-star'+index">
                                            <svg class="star-icon" id="star1" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                                 xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                        </label>
                                        <input class="stars-checkbox" :id="'second-star'+index" type="radio" :name="'star'+index" value="4"
                                               v-model="form.skills[index].rating">
                                        <label class="stars-star" :for="'second-star'+index">
                                            <svg class="star-icon" id="star2" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                                 xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                        </label>
                                        <input class="stars-checkbox" :id="'third-star'+index" type="radio" :name="'star'+index" value="3"
                                               v-model="form.skills[index].rating">
                                        <label class="stars-star" :for="'third-star'+index">
                                            <svg class="star-icon" id="star3" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                                 xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                        </label>
                                        <input class="stars-checkbox" :id="'fourth-star'+index" type="radio" :name="'star'+index" value="2"
                                               v-model="form.skills[index].rating">
                                        <label class="stars-star" :for="'fourth-star'+index">
                                            <svg class="star-icon" id="star4" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 53.867 53.867" style="enable-background:new 0 0 53.867 53.867;"
                                                 xml:space="preserve">
                    <polygon
                        points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182"></polygon>
                  </svg>
                                        </label>
                                        <input class="stars-checkbox" :id="'fifth-star'+index" type="radio" :name="'star'+index" value="1"
                                               v-model="form.skills[index].rating">
                                        <label class="stars-star" :for="'fifth-star'+index">
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

                        </div>

                        <button class="btn btn-info w-100 d-flex align-items-center justify-content-center"
                                v-if="this.max_skills > this.form.skills.length"
                                @click="addNewSkills"
                                type="button">Добавить еще навык
                        </button>
                    </div>


                    <div class="alert custom-alert-2 alert-dismissible fade  show"
                         v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                         v-if="message" role="alert">
                        <i class="bi bi-check-circle"></i>{{message}}
                    </div>

                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                            type="submit">Отправить запрос
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
            messageType:0,
            message:null,
            max_skills: 20,
            form: {
                full_name: null,
                age: 18,
                phone: null,
                description: null,
                need_transfer: true,
                skills:[
                    {
                        title:"",
                        rating:1
                    }
                ],

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

        addNewSkills() {
            let find = this.form.skills.filter(item => item.title.trim() === "").length > 0;

            if (!find && this.max_skills > this.form.skills.length)
                this.form.skills.push(  {
                    title:"",
                    rating:1
                });
        }
    }
}
</script>
