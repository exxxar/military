<template>
    <div class="container">

        <div class="card">
            <div class="card-body direction-rtl">
                <!-- Search Form Wrapper -->
                <div class="alert custom-alert-2 alert-dismissible fade  show"
                     v-bind:class="{'alert-success':messageType===0,'alert-danger':messageType===1}"
                     v-if="message" role="alert">
                    <i class="bi bi-check-circle"></i>{{ message }}
                    <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="search-form-wrapper">


                    <div class="alert custom-alert-2 alert-primary alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i>Сообщения отправляются по расписанию. Запуск рассылки будет
                        осуществлян в ближайщее по расписанию время, близкое к указнному во времени отправки.
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <!-- Search Form -->
                    <form class="mb-3 pb-4 border-bottom" v-on:submit.prevent="sendMessage" ref="announce"
                          id="announce">
                        <div class="form-group mb-2">
                            <label for="title">Заголовок сообщения<span
                                style="color:red;">*</span></label>
                            <input class="form-control form-control-clicked" type="text" id="title"
                                   placeholder="Иванов" v-model="form.title" required>
                        </div>


                        <div class="form-group mb-2">
                            <label for="text">Текст сообщеня {{ form.text.length }}/500<span
                                style="color:red;">*</span></label>
                            <textarea class="form-control" id="text"
                                      placeholder="Сообщение"
                                      maxlength="500"
                                      v-model="form.text" required>
                            </textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="need_send_at">Время отправки
                                <span style="color:red;">*</span></label>
                            <input class="form-control form-control-clicked" type="datetime-local" id="need_send_at"
                                   v-model="form.need_send_at" required>
                        </div>

                        <div class="form-group">

                            <label class="form-label">Ссылки на изображения
                                ({{ form.images.length }}/{{ max_images }})</label>
                            <div v-for="(item,index) in form.images">
                                <a type="button" class="text-secondary small mb-2 w-100"
                                   @click="removeImage(index)">Удалить</a>
                                <input class="form-control mb-2" :id="'clothes'+index" type="text"
                                       placeholder="Ссылка на изображение"
                                       v-model="form.images[index]" required>
                            </div>

                            <button class="btn btn-info w-100 d-flex align-items-center justify-content-center mt-2"
                                    @click="addImage"
                                    v-if="this.max_images>this.form.images.length"
                                    type="button">Добавить ссылку на изображение
                            </button>
                        </div>

                        <div class="form-group mb-2">

                            <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                                    type="submit" :disabled="loader">
                        <span v-if="!loader">Поставить сообщение в очередь
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

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="mt-2">Найдено сообщений в базе (не больше 20 последних):</h5>
                <li class="list-group-item d-flex align-items-center mt-2 justify-content-between"
                    style="cursor: pointer"
                    :key="index"
                    v-if="messages.length>0"
                    v-for="(item, index) in messages"
                >
                    <div class="row" @click="fill(item)">
                        <div class="col-12"> {{ item.title }}</div>
                        <div class="col-12"><span
                            class="badge bg-primary rounded-pill">Дата размещения {{ item.created_at }}</span></div>
                        <div class="col-12"><span class="badge bg-primary rounded-pill">Дата заплавнированной отправки {{
                                item.need_send_at
                            }}</span></div>
                        <div class="col-12" v-if="item.sent_at!=null">
                            <p>Дата фактический отправки <span class="badge bg-info">{{ item.sent_at }}</span></p>
                        </div>
                        <div class="col-12 mt-2"><p class="w-100">
                            {{ item.text }}
                        </p></div>

                        <div class="col-12" v-if="item.images.length>0">
                            <h6>Изображения к сообщению:</h6>
                            <ul>
                                <li v-for="(sub,index2) in item.images" style="list-style: decimal"><a
                                    class="btn btn-link"
                                    :href="sub" target="_blank">{{ sub }}</a></li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-danger" @click="remove(item.id)" :disabled="loader">
                                <span v-if="!loader">Удалить</span>
                                <span v-else><img src="/img/loader.gif" class="loader-btn" alt=""></span>
                            </button>
                        </div>
                    </div>


                </li>
                <p v-else>Сообщений не найдено</p>
            </div>
        </div>
    </div>
</template>
<script>


export default {
    data() {
        return {
            loader: false,
            messageType: 0,
            message: null,
            messages: [],
            max_images: 10,
            form: {
                text: "",
                title: "",
                need_send_at: null,
                images: [],
            }
        }
    },

    mounted() {
        this.loadOldMessages()
        this.form.need_send_at = this.prepareDate()
    },
    methods: {
        loadOldMessages() {
            axios.get("/forms/announces/load-old").then(resp => {
                this.messages = resp.data.data
            })
        },
        fill(item) {
            this.form = Object.assign({}, item);
            this.form.need_send_at = this.prepareDate(this.form.need_send_at)
        },
        remove(id) {
            this.loader = true
            this.message = null
            this.messageType = 0;

            axios.delete("/forms/announces/remove/" + id).then(resp => {
                this.message = "Успешно удалено"
                this.messageType = 0;
                this.loader = false
                this.loadOldMessages()

            }).catch(() => {
                this.message = "Ошибка удаления"
                this.messageType = 1;
                this.loader = false
            })
        },
        sendMessage() {
            this.loader = true
            this.message = null
            this.messageType = 0;

            axios.post('/forms/announces/send-message', this.form).then(resp => {

                this.message = "Успешно отправлено"
                this.messageType = 0;


                this.loader = false

                this.form = {
                    text: "",
                    title: "",
                    need_send_at: null,
                    images: [],
                }

                this.loadOldMessages()


            }).catch(() => {
                this.message = "Ошибка отправки"
                this.messageType = 1;
                this.loader = false
            })


        },
        addImage() {
            this.form.images.push("");
        },
        removeImage(index) {
            this.form.images.splice(index, 1);
        },
        prepareDate(datetime) {
            let date = datetime ? new Date(datetime) : new Date();

            let month = ('0' + (date.getMonth() + 1)).slice(-2);
            let day = ('0' + date.getDate()).slice(-2);
            let year = date.getFullYear();

            let h = date.getHours();
            let m = date.getMinutes()

            if (("" + h).length == 1)
                h = "0" + h;

            if (("" + m).length == 1)
                m = "0" + m;


            return year + '-' + month + '-' + day + "T" + h + ":" + m;

        },

    }
}
</script>
