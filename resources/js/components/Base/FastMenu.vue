<template>
    <div class="container">
        <h6>Быстрый доступ</h6>

        <div class="fast-menu-slides-wrapper">
            <div class="fast-menu-slides mb-2">
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-file-earmark-medical"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Заявк на помощь</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-file-earmark-richtext"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Анкета волонтера</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-cart4"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Продукты или медикменты</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="fa-solid fa-hand-holding-droplet"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Вода</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-truck"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Перевозки или доставка</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="fa-solid fa-shirt"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Одежда</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-archive"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Работа</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-archive"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Разбор завалов</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-archive"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Помогу с питанием</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-archive"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Помогу с вещами</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-archive"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Новое убежище</p>
                        </a>
                    </div>
                </div>
                <!-- Single Status Slide -->
                <div>
                    <div class="fast-menu-slide">
                        <a href="#">
                            <span><i class="bi bi-archive"></i></span>
                            <div class="active-status"></div>
                            <p class="mb-0 mt-2 ">Новый центр помощи</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style lang="scss">
.fast-menu-slide
{
    display: flex;
    justify-content: center;
    max-width: 50px;
    width: 100%;
    span {
        display: flex;
        background-color: #578CFF;
        padding: 10px 14px;
        justify-content: center;
        align-items: center;
        color: white;
        border-radius: 10px;
        height: 40px;
        width: 40px;
    }

    a {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        p {
            font-size: 8px;
            text-align: center;
            line-height: 100%;
            color:black;
            word-break: break-word;
        }
    }

    .disabled-status {
        &:after{
            content: '\F47B';
        }
    }

    .active-status {

    }
}

</style>
