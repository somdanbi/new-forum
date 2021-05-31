<template>
    <div>
        <div v-if="signedIn">
                <textarea name="body" id="body" rows="5"
                          placeholder ="Something to say?" class="form-control"
                          v-model="body"
                          required>

                </textarea>
            </div>

            <button type="submit"
                    class="btn btn-primary"
                    @click="addReply">Post</button>


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

    computed:{
        signedIn(){
            return window.App.signedIn;
        }
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
