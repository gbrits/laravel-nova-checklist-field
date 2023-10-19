<template>
    <div>
        <div class="flex">
            <input
                :id="item.id"
                type="text"
                name="new-item"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="placholderText"
                v-model="item.body"
                v-on:keydown.enter.prevent="addItem"
            />
            <button class="ml-3 " v-show="item.body.length > 0" :disabled="item.body.length == 0" @click.prevent="addItem" type="button" name="new-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
            </button>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['field'],
        data() {
            return {
                item: this.freshItem()
            };
        },
        methods: {
            freshItem(){
                return {
                    id: this.uuidv4(),
                    body: '',
                    created_at: null,
                    created_by: null,
                    completed_at: null,
                    completed_by: null,
                };
            },
            addItem() {
                if(this.item.body.length > 0){
                    if(this.field.user){
                        this.item.created_by = this.field.user;
                    }
                    this.item.created_at = Date.now();
                    this.$emit('created', this.item);
                    this.item = this.freshItem();
                }
            },
            uuidv4() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            }
        },
        computed: {
            placholderText(){
                return (this.field.placeholder || 'Add item ' ) + (this.field.placeholder_count ? (this.$parent.items.length+1) : '');
            }
        }
    }
</script>