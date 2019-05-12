<template>
    <span class="tg-stars"><span :class="className"></span></span>
</template>

<script>
    export default {
        data() {
            return {
                listRatings: {
                    1: 'one',
                    2: 'two',
                    3: 'three',
                    4: 'four',
                    5: 'five'
                }
            }
        },
        props: {
            rating: {
                required: true
            }
        },
        computed: {
            className: function() {
                return this.listRatings[Math.round(this.rating)];
            }
        }
    }
</script>
