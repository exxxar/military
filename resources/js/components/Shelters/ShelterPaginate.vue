<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-two justify-content-center">
            <li class="page-item"><a class="page-link" href="#first" aria-label="first"
                                     @click="currentPage=0">
                <svg class="bi bi-chevron-left" width="16" height="16" viewBox="0 0 16 16"
                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                </svg>
            </a></li>
            <li class="page-item"
                v-bind:class="{'active':page===currentPage}"
                v-for="page in preparedPages"><a class="page-link" href="#page"
                                                 @click="changeCurrentPage(page)">{{ page + 1 }}</a>
            </li>
            <!--                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">9</a></li>-->
            <li class="page-item"><a class="page-link" href="#last" aria-label="Next" @click="last">
                <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 16 16"
                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
            </a></li>
        </ul>
    </nav>
</template>
