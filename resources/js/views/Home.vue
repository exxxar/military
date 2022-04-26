<template>


    <div class="container">
        <div class="card">
            <div class="card-body">

                <div
                    v-if="!user.is_admin"
                    class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert"><i
                    class="bi bi-check-circle"></i>
                    Спасибо что пользуетесь нашей системой:)
                    <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div v-else>
                    <div
                        v-if="user.is_working_now"
                        class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert"><i
                        class="bi bi-check-circle"></i>
                        В данный момент вы за работой! Ваше рабочее время с {{user.start_at||"не задано"}} до {{user.end_at||"не задано"}}
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div
                        v-if="!user.is_working_now"
                        class="alert custom-alert-2 alert-danger alert-dismissible fade show" role="alert"><i
                        class="bi bi-check-circle"></i>
                        В данный момент вы не работаете! Ваше рабочее время с {{user.start_at||"не задано"}} до {{user.end_at||"не задано"}}
                        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <functions-page/>
</template>

<script>
export default {
    computed: {
        mode: function () {
            return window.mode
        },
        user: function (){
            return window.user
        }
    }
}
</script>
