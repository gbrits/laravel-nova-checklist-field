<template>
    <div class="p-4">
        <h1 v-if="!$parent.edit" class="text-lg">Checklist Items</h1>
        <items :items="value" :field="field" :edit="false"></items>
    </div>
</template>

<script>
    import Items from './Items.vue';
    export default {
        components: {Items},
        props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
        computed:{
            value(){
                return JSON.parse(this.field.value) || [];
            }
        },
    }
</script>