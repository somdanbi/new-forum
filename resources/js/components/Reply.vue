<template>
    <div :id="'reply-'+id" class="card">

        <div class="card-header">
            <div class="level">
                <h5 class="flex">
                    <a :href="'/profiles/'+data.owner.name"

                       v-text="data.owner.name">

                    </a>
                    said <span v-text="ago"></span>
                </h5>


                <div v-if="signIn">
                    <favorite :reply="data"></favorite>

                </div>

            </div>

        </div>
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-info btn-sm" @click="update">Update</button>
                <button class="btn btn-link btn-sm" @click="editing = false">Cancel</button>

            </div>

            <div v-else v-text="body">

            </div>
        </div>

        <!--@can('update',$reply)-->
        <div class="card-footer level" v-if="canUpdate">
            <button class="btn btn-info btn-sm mr-1" @click="editing = true">Edit</button>
            <button class="btn btn-danger btn-sm mr-1" @click="destroy">Delete</button>


        </div>
        <!--@endcan-->
    </div>
</template>

<script>
import Favorite from './Favorite.vue';
import moment from 'moment';
export default {
    props: ['data'],
    components: { Favorite },

    data(){
        return {
            editing:false,
            id: this.data.id,
            body: this.data.body
        };
    },
    computed: {
        ago(){
            return moment(this.data.created_at).fromNow() + '...';
        },
        signIn(){
            return window.App.signIn;
        },
        canUpdate(){
            return this.authorize(user => this.data.user_id == user.id);
        }
    },
    methods: {
        update() {
            axios.patch('/replies/' + this.data.id, {
                body: this.body
            });

            this.editing = false;
            flash('Updated!');
        },

        destroy(){
            axios.delete('/replies/' + this.data.id);
            this.$emit('deleted', this.data.id);

        }
    }
}
</script>
