<template>

    <div class="page-content-wrapper py-3">
        <div class="container">
            <a href="/forms/need-people-search" target="_blank" class="card service-card bg-info bg-gradient mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="service-text">
                            <h5>Заявка на поиск человека \ добавление человека в базу</h5>
                            <p class="mb-0">Добавление новой заявки на поиск</p>
                        </div>
                        <div class="service-img"><img src="img/human.png" alt=""></div>
                    </div>
                </div>
            </a>

            <a href="/forms/h-aid" target="_blank" class="card service-card bg-info bg-gradient mb-3" v-if="user.is_admin||mode=='offline'">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="service-text">
                            <h5>Гуманитарная помощь</h5>
                            <p class="mb-0">Поиск и добавление информации о получателе гумонитарной помощи</p>
                        </div>
                        <div class="service-img"><img src="img/h-aid.png" alt=""></div>
                    </div>
                </div>
            </a>

            <a href="/forms/request-people" target="_blank"  class="card service-card bg-primary bg-gradient mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="service-text">
                            <h5>Поиск человека по локальной базе</h5>
                            <p class="mb-0">Осуществляем поиск людей по уже имеющейся локальной базе</p>
                        </div>
                        <div class="service-img"><img src="img/search.png" alt=""></div>
                    </div>
                </div>
            </a>

            <a href="/forms/send-announce" target="_blank"
               v-if="user.is_admin&&mode=='online'"
               class="card service-card bg-success bg-gradient mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="service-text">
                            <h5>Массовая рассылка</h5>
                            <p class="mb-0">Ставит ваше сообщение в очередь рассылки</p>
                        </div>
                        <div class="service-img"><img src="img/messages.png" alt=""></div>
                    </div>
                </div>
            </a>

            <a href="/forms/excel/export-people" target="_blank"
               v-if="user.is_admin||mode=='offline'"
               class="card service-card bg-warning bg-gradient mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="service-text">
                            <h5>Экспорт локальной базы в EXCEL</h5>
                            <p class="mb-0">Скачать всю локальную базу в виде документа EXCEL</p>
                        </div>
                        <div class="service-img"><img src="img/excel.png" alt=""></div>
                    </div>
                </div>
            </a>


            <a href="/forms/pdf/export-people" target="_blank"
               v-if="user.is_admin||mode=='offline'"
               class="card service-card bg-warning bg-gradient mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="service-text">
                            <h5>Экспорт локальной базы в PDF</h5>
                            <p class="mb-0">Скачать всю локальную базу в виде документа PDF</p>
                        </div>
                        <div class="service-img"><img src="img/pdf.png" alt=""></div>
                    </div>
                </div>
            </a>

        </div>
    </div>
</template>

<script>
export default {
    computed:{
        user() {
            return window.user
        },
        mode() {
            return window.mode
        },

    }
}
</script>
