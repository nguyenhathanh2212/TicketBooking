<template>
    <div class="tg-select">
        <select class="my-selectpicker" @change="getValue($event)" data-live-search="true" data-width="100%">
            <option value="" selected disabled data-hidden="true">{{ this.placeHolder }}</option>
            <option :selected="valueSelected == item.id ? true : false"
                :disabled="valueDisabled == item.id ? true : false"
                :data-hidden="valueDisabled == item.id ? true : false"
                v-for="(item, index) in data"
                :key="index"
                :value="item.id"
                :data-tokens="item.id">{{ item.name }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                value: ''
            }
        },
        props: [
            'data',
            'placeHolder',
            'valueSelected',
            'valueDisabled'
        ],
        watch: {
            valueDisabled: function() {
                $('.my-selectpicker').selectpicker();
            },
            valueSelected: function() {
                event.target.value = this.valueSelected;
            }
        },
        updated() {
            $('.my-selectpicker').selectpicker();
        },
        methods: {
            getValue: function(event) {
                this.value = event.target.value;
                this.$emit('selectOptionChange', this.value);
            }
        }
    }
</script>
