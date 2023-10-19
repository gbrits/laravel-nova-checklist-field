<template>
  <span class="flex ml-2" v-html="indexText"></span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
    computed:{
        items(){
            return JSON.parse(this.field.value) || [];
        },
        completed(){
            return this.items.filter(item => item.completed_at != null)
        },
        indexText(){
          if(this.field.show_item_status && this.field.show_completion){
            return this.itemStatus + ' - ' + this.completion;
          }
          if(this.field.show_item_status){
            return this.itemStatus;

          }
          if(this.field.show_completion){
            return this.completion;
          }
          return this.items.length;
        },
        itemStatus(){
            return this.completed.length + ' / ' + this.items.length;
        },
        completion(){
          const percentile = Math.round((this.completed.length/this.items.length)*100);
          let color;

          if (percentile <= 33.3) {
              color = 'red';
          } else if (percentile > 33.3 && percentile <= 66.6) {
              color = 'orange';
          } else {
              color = 'green';
          }

          return '<span style="color: ' + color + ';">' + percentile + '%</span>';
      }

    },
}
</script>