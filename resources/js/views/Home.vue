<template>


    <div class="container">
        <div class="card">
            <div class="card-body">

                <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert"><i
                    class="bi bi-check-circle"></i>
                    Спасибо что пользуетесь нашей системой:)
                    <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
                            data-bs-dismiss="alert" aria-label="Close"></button>
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
        }
    }
}
</script>
