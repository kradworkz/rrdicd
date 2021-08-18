<template>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
             <h5 v-if="show  == true" class="font-size-15"><i class="bx bx-message-dots text-muted align-middle mr-1"></i> {{comments.length}} Comments :</h5>
                <button type="button" @click="close"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-1">
                <div class="card-body">

                    <div v-if="show  == true" style="margin-top: -30px;">
                        <simplebar style="height:65vh;" ref="feed">
                            <div class="media py-3 border-bottom" v-for="comment in comments" v-bind:key="comment.id">
                                <div class="avatar-xs mr-3">
                                    <img :src="currentUrl+'/images/avatars/'+comment.avatar" alt="" class="img-fluid d-block rounded-circle">
                                </div>
                            
                                <div class="media-body">
                                    <h5 class="font-size-14 mb-1">{{comment.user}} <small class="text-muted float-right"><i class='bx bx-time-five'></i> {{comment.created_at}}</small></h5>
                                    <p class="text-muted">{{comment.comment}}</p>
                                    <div>
                                        <a @click="like(0,comment.id,'main')" class="text-success">
                                            <span v-if="comment.likes.length > 0">{{comment.likes.length}}</span> 
                                            <i v-bind:class="[(comment.likes.find(like => like.user_id === user_id) ? 'bx bxs-like' : 'bx bx-like text-secondary')]"></i> <span v-bind:class="[(comment.likes.find(like => like.user_id === user_id) ? 'text-success' : 'text-secondary')]"> Like </span></a>
                                        <a @click="subcomment(comment.id)" class="text-secondary"><i class='bx bx-reply-all'></i> Reply</a>
                                    </div>

                                    <div class="text-center font-size-11 my-1" v-if="comment.subcomments.length > 0">
                                        <a @click="subcomment(comment.id)" class="text-success"><i class='bx bx-alarm-exclamation bx-tada font-size-12 align-middle mr-2'></i> View {{comment.subcomments.length}} replies</a>
                                    </div>
                                </div>
                            </div>
                            <div class="app-search d-none d-lg-block">
                                <div class="position-relative">
                                    <input v-on:keyup.enter="store" v-model="text" type="text" class="form-control" placeholder="Aa">
                                    <span class='bx bx-comment-dots'></span>
                                </div>
                            </div>
                        </simplebar>
                    </div>

                    <div v-else  style="margin-top: -30px;">
                        <div class="media py-2">
                            <div class="avatar-xs mr-3">
                                <img :src="currentUrl+'/images/avatars/'+temp.avatar" alt="" class="img-fluid d-block rounded-circle">
                            </div>
                            <div class="media-body">
                                <h5 class="font-size-14 mb-1">{{temp.user}} <small class="text-muted float-right"><i class='bx bx-time-five'></i> {{temp.created_at}}</small></h5>
                                <p class="text-muted">{{temp.comment}}</p>
                                <div>
                                    <a @click="like(0,temp.id,'main')" class="text-success">
                                            <span v-if="temp.likes.length > 0">{{temp.likes.length}}</span> 
                                            <i v-bind:class="[(temp.likes.find(like => like.user_id === user_id) ? 'bx bxs-like' : 'bx bx-like text-secondary')]"></i> <span v-bind:class="[(temp.likes.find(like => like.user_id === user_id) ? 'text-success' : 'text-secondary')]"> Like </span></a>
                                    <a @click="subcomment(temp.id)" class="text-secondary"><i class='bx bx-reply-all'></i> Reply</a>
                                </div>
                                
                                <simplebar style="max-height:40vh;" ref="feed">
                                    <div class="media pt-3" v-for="c in temp.subcomments" v-bind:key="c.id">
                                        <div class="avatar-xs mr-3">
                                            <div class="avatar-title rounded-circle bg-light text-primary">
                                                <img :src="currentUrl+'/images/avatars/'+c.avatar" alt="" class="img-fluid d-block rounded-circle">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="font-size-14 mb-1"> {{c.user}} <small class="text-muted float-right"><i class='bx bx-time-five'></i> {{c.created_at}}</small></h5>
                                            <p class="text-muted">{{c.comment}}</p>
                                            <div>
                                                <a @click="like(temp.id,c.id,'sub')" class="text-success">
                                                    <span v-if="c.likes.length > 0">{{c.likes.length}}</span> 
                                                    <i v-bind:class="[(c.likes.find(like => like.user_id === user_id) ? 'bx bxs-like' : 'bx bx-like text-secondary')]"></i> <span v-bind:class="[(c.likes.find(like => like.user_id === user_id) ? 'text-success' : 'text-secondary')]"> Like </span></a>
                                                <a @click="subcomment(c.id)" class="text-secondary"><i class='bx bx-reply'></i> Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </simplebar>
                            </div>
                        </div>
                        <div class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input v-on:keyup.enter="store" v-model="text" type="text" class="form-control" placeholder="Aa">
                                <span class='bx bx-comment-dots'></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import simplebar from 'simplebar-vue';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination : {},
                comments: [],
                text: '',
                id: '',
                mainId: '',
                type: 'Comment',
                show: true,
                temp : {},
                user_id : ''
            }
        },

        created(){
            this.fetchId();
        },  
    
        methods : {

            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                    total: meta.total,
                };
                this.pagination = pagination;
            },

            fetchId(){
                axios.get(this.currentUrl + '/request/getid')
                .then(response => {
                    this.user_id = response.data;
                })
                .catch(err => console.log(err));
            },

            setId(id){
                this.mainId = id;
                this.fetch();
                this.scrollToBottom();
            },

            fetch(page_url){
                let vm = this; 
                page_url = page_url || this.currentUrl + '/request/comments/'+this.mainId;

                axios.get(page_url)
                .then(response => {
                    this.comments = response.data.data;
                    vm.makePagination(response.data.meta, response.data.links);
                })
                .catch(err => console.log(err));
            },

            store(){
                axios.post(this.currentUrl + '/request/comment/store', {
                    id: (this.type == 'Sub') ? this.id : this.mainId,
                    comment: this.text,
                    type: this.type
                })
                .then(response => {
                    if(this.type == "Sub"){
                        let com = this.comments.find(comment => comment.id === this.id);
                        com.subcomments.push(response.data.data);
                    }else{
                        let com = this.comments.find(comment => comment.id === this.mainId);
                        this.comments.push(response.data.data);
                    }
                    this.text = '';
                    this.scrollToBottom();
                    Vue.$toast.success('<strong>Comment Posted</strong>', {
                        position: 'bottom-right'
                    });
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },

            like(main,id,liketype){ 
                let type; 
                let com;

                if(liketype == 'main'){
                     com = this.comments.find(comment => comment.id === id);
                    (com.likes.find(like => like.user_id === this.user_id)) ? type = 'remove' : type = 'add'; 
                }else{
                    com = this.comments.find(comment => comment.id === main);
                    com = com.subcomments.find(comment => comment.id === id);
                    (com.likes.find(like => like.user_id === this.user_id)) ? type = 'remove' : type = 'add'; 
                }

                axios.post(this.currentUrl + '/request/like/add', {
                    comment: id,
                })
                .then(response => {
                    if(type == 'add'){
                        com.likes.push(response.data.data);
                    }else{
                        let i = com.likes.map(like => like.id).indexOf(response) // find index of your object
                        com.likes.splice(i, 1)
                    }
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },

            subcomment(id){
                this.id = id;
                this.type = 'Sub';
                this.show = false;
                let com = this.comments.find(comment => comment.id === this.id);
                this.temp = com;
            },

            close(){
                this.show = true;
                this.type = "Comment";
            },

            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollElement.scrollTop = this.$refs.feed.scrollElement.scrollHeight - this.$refs.feed.scrollElement.clientHeight;
                }, 50);
            }
         }, components: { simplebar }
    }
</script>
