<template>
    <div>
<!--        @if(auth()->check())-->

<!--        <form method="post" action="{{ $thread->path(). '/replies' }}">-->

            <div class="form-group">
                <textarea name="body" id="body" rows="5"
                          placeholder ="Something to say?" class="form-control"
                          v-model="body"
                          required>

                </textarea>
            </div>

            <button type="submit"
                    class="btn btn-primary"
                    @click="addReply">Post</button>

<!--        </form>-->
<!--        @else-->
<!--        <p class="text-cent-->
<!--            replie :data={{$thread->replies}}ser">Please-->
<!--            <a href="{{ route('login') }}">Sign in</a>-->
<!--            to participate in this discussion-->
<!--        </p>-->
<!--        @endif-->
    </div>
</template>

<script>
export default {

    data() {
        return {
            body: '',
            endpoint:'/threads/et/1/replies'
        };
    },

    methods: {
        addReply() {
            axios.post(this.endpoint, { body: this.body})
            .then(({data}) => {
                this.body = '';

                flash('Your reply has been post');
                this.$emit('created', data);
            });
        }
    }

}
</script>
