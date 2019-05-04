<template>
    <input
        id="date-away-input"
        :value="data"
        @change="getValue($event)"
        type="text"
        class="date-time-picker date-away-input"
        placeholder="Ngày đi">
</template>

<script>
    export default {
        data: function() {
            return {
                dateFormat: 'DD/MM/YYYY',
                value: '',
            }
        },
        props: {
            data: {
                default: ''
            }
        },
        mounted() {
            this.dateFormat = window.Laravel.locale == 'vn' ? 'DD/MM/YYYY' : 'MM/DD/YYYYY';
            $('.date-time-picker').datetimepicker({
                format: this.dateFormat
            });
        },
        methods: {
            getValue: function(event) {
                this.value = event.taget;
                this.$emit('dateChange', this.value);
            }
        }
    }
</script>
