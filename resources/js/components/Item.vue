<template>
    <div class="my-3">
        <div class="flex justify-between" v-if="$parent.edit">
            <div class="flex w-full items-center align-center">
                <checkbox
                    :value="item.id"
                    :checked="isChecked"
                    @input="toggleCheckbox"
                    class="pr-2 mr-2"/>
                <label
                    :for="item.id"
                    class="w-full">
                    <input class="w-full form-control form-input form-input-bordered border-dashed" v-on:keydown.enter.prevent v-model="item.body"/>
                </label>
            </div>
            <div class="flex ml-2 items-center">
                <button style="display: flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background-color: #f44336; color: white; font-size: 18px; border: none; outline: none; cursor: pointer;" @click.prevent="destroy" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 70%; height: 70%; margin: auto;">
                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                </svg>
                </button>
            </div>
        </div>
        <div v-else class="flex">
            <div class="flex items-center mr-2">
                <div class="flex" v-if="isChecked">
                    <div style="display: flex; align-items: center; justify-content: center; width: 20px; height: 20px; border-radius: 50%; background-color: #0ca37f; color: white; font-size: 18px; border: none; outline: none; cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                </div>
                <div class="flex" v-else>
                    <div style="display: block; border: 1px solid #eaeaea; width: 20px; height: 20px; border-radius: 100%">
                    </div>
                </div>
            </div>
            <div class="flex flex-row flex-col">
                <span :class="isChecked ? 'line-through text-80' : ''" v-text="item.body"></span>
                <span class="text-50 text-gray-400 text-xs" v-if="secondLineText" v-text="secondLineText"></span>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from 'moment';
    export default {
        props: ['item', 'field'],
        methods: {
            toggleCheckbox() {
                if (this.item.completed_at) {
                    this.item.completed_by = null;
                    this.item.completed_at = null;
                } else {
                    this.item.completed_by = this.field.user;
                    this.item.completed_at = Date.now();
                }
            },
            destroy(){
                this.$emit('deleted', this.id);
            },
        },
        computed: {
            isChecked() {
                return this.item.completed_at != null
            },
            completedAt(){
                if(this.item.completed_at){
                    return moment(this.item.completed_at).fromNow()

                }
                return null;
            },
            secondLineText(){
                if(this.completedAt && this.field.user){
                    return `Completed by ${this.item.completed_by} - ${this.completedAt}`;
                }
                if(this.field.show_timestamps && this.completedAt){
                    return this.completedAt;
                }
                if(this.field.user){
                    return this.item.completed_by;
                }
                return null
            }
        }
    }
</script>
