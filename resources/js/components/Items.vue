<template>
    <div class="w-full">
        <div v-for="(item, index) in items" :key="item.id">
            <item class="mt-2" :item="item" :field="field" @deleted="remove(index)"></item>
        </div>
        <new-item class="mt-2" @created="add" :field="field" v-if="edit"></new-item>
    </div>
</template>

<script>
    import Item from './Item.vue';
    import NewItem from './NewItem.vue';
    export default {
        components: { Item, NewItem },
        props: ['items', 'field', 'edit'],
        data() {
            return {
                // Initialize the "items" data property with the "items" prop
                // passed down from the parent component
                items: this.items
            };
        },
        created() {
            // If no "items" prop is passed down from the parent component,
            // initialize the "items" data property with an empty array
            if (!this.items) {
                this.items = [];
            }
        },
        methods: {
            add(item) {
                this.items.push(item);

                this.$emit('added', this.items);
            },

            remove(index) {
                this.items.splice(index, 1);

                this.$emit('removed', this.items);
            }
        }
    }
</script>