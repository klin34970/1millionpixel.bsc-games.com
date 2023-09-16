<template>
    <div class="buy-info">
        {{ $parent.w }}x{{ $parent.h }} = {{ $parent.w * $parent.h }} pixels at position ({{ $parent.x }}, {{ $parent.y }})
        <div>
            Price: {{ price($parent.w, $parent.h) }} {{ chain.token }} + gas fees.
        </div>
        <div class="" v-if="show">
            <button @click="buyButton" class="bg-gradient-to-b from-tree-300 to-tree-600 text-white font-bold py-2 px-4 rounded-lg uppercase text-sm shadow-xl">Buy Pixels</button>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['chain', 'show'],
        data(){
            this.$gtag.event('buy-open', {
                event_category: this.chain.token,
                event_label: 'button',
                value: 'click'
            })
        },
        methods:{
            buyButton(){
                this.$emit('buyButton');
                this.$gtag.event('buy-modal', {
                    event_category: this.chain.token,
                    event_label: 'modal',
                    value: 'open'
                })
            },
            price(height, width) {
                return Math.ceil(height * width * this.chain.contract['1million'].price_per_pixel * 100) / 100;
            },

        }
    }
</script>
