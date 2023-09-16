<template>
    <a :href="ad.link" :style="style" :title="ad.title" class="absolute" target="_blank"></a>
</template>

<script>
    export default {
        props: ['ad'],
        computed: {
            style(){
                if (!this.ad.width) {
                    return {
                        "display": "none",
                    }
                }
                const s = {
                    "left": this.ad.x * 10 + "px",
                    "top": this.ad.y * 10 + "px",
                    "width": this.ad.width * 10 + "px",
                    "height": this.ad.height * 10 + "px",
                    "background": "url(" + this.ad.image + ")",
                    "background-size": "contain",
                    // "background-color": "#2e2e2e"
                }
                if (!this.ad.image) {
                    s["background"] = "#f9d37f";
                }
                return s;
            }
        }
    }
</script>
