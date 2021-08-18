<template>
    <div>
        <ul class="list-inline user-chat-nav text-right mb-0 dropdown">
            
            <li @click="close('back')" class="list-inline-item d-non d-sm-inline-block">
                <button type="button" class="btn btn-light">
                    <span class="d-none d-sm-inline-block "><i class='bx bxs-left-arrow-circle'></i></span>
                </button>
            </li>
        </ul>
        <hr>
        </hr>
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div>
                    <div class="text-center">
                        <div class="mb-4">
                            <a href="#" :class="'badge badge-'+research.color+' font-size-12'">
                                <i class="bx bx-purchase-tag-alt align-middle text-muted mr-1"></i>
                                {{ research.status }}
                            </a>
                        </div>
                        <h4 class="text-primary font-size-14">{{research.title}}</h4>
                        <p class="text-muted font-size-11 mb-4"><i
                                class="mdi mdi-calendar mr-1"></i>{{research.created_at }} </p>
                    </div>

                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <p class="text-muted mb-2 font-size-11">Classification</p>
                                    <h5 class="font-size-13">{{ research.classification.name }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <p class="text-muted font-size-11 mb-2">Specialty</p>
                                    <h5 class="font-size-13">{{ research.specialty.name }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <p class="text-muted font-size-11 mb-2">Post by</p>
                                    <h5 class="font-size-13">{{ research.name }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="mt-4">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="row">


                                    <div class="col-sm-2">
                                        <div class="card shadow-none border">
                                            <div class="card-body p-3">
                                                <div class="">
                                                    <div class="float-right ml-2">
                                                        <div class="dropdown mb-2">
                                                            <a class="font-size-16 text-muted dropdown-toggle"
                                                                role="button" data-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#">Open</a>
                                                                <a class="dropdown-item" href="#">Edit</a>
                                                                <a class="dropdown-item" href="#">Rename</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-xs mr-3 mb-3">
                                                        <div class="avatar-title bg-transparent rounded">
                                                            <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="overflow-hidden mr-auto">
                                                            <h6 class="font-size-12 text-truncate mb-1"><a
                                                                    href="javascript: void(0);"
                                                                    class="text-body">Reasearch</a></h6>
                                                            <p class="text-muted font-size-10 text-truncate mb-0">20
                                                                Files</p>
                                                        </div>
                                                        <div class="align-self-end font-size-10 ml-2">
                                                            <p class="text-muted mb-0">Upload</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                        </div>
                        <div class="text-muted font-size-14">
                            <span v-html="research.content"></span>
                        </div>

                        <hr>

                        <div class="mt-5">
                            <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle mr-1"></i>
                                Comments :</h5>

                            <div>
                                <div class="media py-3">
                                    <div class="avatar-xs mr-3">
                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                            <i class="bx bxs-user"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="font-size-14 mb-1">Delores Williams <small
                                                class="text-muted float-right">1 hr Ago</small></h5>
                                        <p class="text-muted">If several languages coalesce, the grammar of the
                                            resulting language is more simple and regular than that of the individual
                                        </p>
                                        <div>
                                            <a href="javascript: void(0);" class="text-success"><i
                                                    class="mdi mdi-reply"></i> Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="media py-3 border-top">
                                    <div class="avatar-xs mr-3">
                                        <img src="assets/images/users/avatar-2.jpg" alt=""
                                            class="img-fluid d-block rounded-circle">
                                    </div>
                                    <div class="media-body">
                                        <h5 class="font-size-14 mb-1">Clarence Smith <small
                                                class="text-muted float-right">2 hrs Ago</small></h5>
                                        <p class="text-muted">Neque porro quisquam est, qui dolorem ipsum quia dolor sit
                                            amet</p>
                                        <div>
                                            <a href="javascript: void(0);" class="text-success"><i
                                                    class="mdi mdi-reply"></i> Reply</a>
                                        </div>

                                        <div class="media pt-3">
                                            <div class="avatar-xs mr-3">
                                                <div class="avatar-title rounded-circle bg-light text-primary">
                                                    <i class="bx bxs-user"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="font-size-14 mb-1">Silvia Martinez <small
                                                        class="text-muted float-right">2 hrs Ago</small></h5>
                                                <p class="text-muted">To take a trivial example, which of us ever
                                                    undertakes laborious physical exercise</p>
                                                <div>
                                                    <a href="javascript: void(0);" class="text-success"><i
                                                            class="mdi mdi-reply"></i> Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media py-3 border-top">
                                    <div class="avatar-xs mr-3">
                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                            <i class="bx bxs-user"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="font-size-14 mb-1">Keith McCoy <small
                                                class="text-muted float-right">12 Aug</small></h5>
                                        <p class="text-muted">Donec posuere vulputate arcu. phasellus accumsan cursus
                                            velit</p>
                                        <div>
                                            <a href="javascript: void(0);" class="text-success"><i
                                                    class="mdi mdi-reply"></i> Reply</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade exampleModal" id="comment" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <research-comment userId="user_id" :id="id" ref="comment"></research-comment>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'research': Object
        },
        data() {
            return {
                currentUrl: window.location.origin,
                errors: [],
                id: 0,
            }
        },


        // created(){
        //     this.fetch();
        // },

        methods: {
            // fetch(){
            //     axios.get(this.currentUrl + '/request/researcher/research/'+this.research_id)
            //     .then(response => {
            //         this.research = response.data.data;
            //         vm.makePagination(response.data.meta, response.data.links);
            //     })
            //     .catch(err => console.log(err));
            // }

            close(type) {
                if (type == 'back') {
                    this.$emit('status', type);
                } else {
                    this.$emit('status', type);
                }

            },

            comment() {
                this.$refs.comment.setId(this.research.id);
                $("#comment").modal('show');
            }
        }
    }

</script>
