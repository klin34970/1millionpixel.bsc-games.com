<template>
    <div class="bg-sand-400 w-full">
        <header>
            <div class="grid grid-cols-3 py-4 px-6">
                <div>
                    <a href="/"><img class="h-8" src="/images/logos.png" /></a>
                </div>
                <div class="flex justify-center">
                    <button v-if="showGrid" @click="buy" class="bg-gradient-to-b from-tree-300 to-tree-600 text-white font-bold py-2 px-4 rounded-lg uppercase text-sm shadow-xl">Buy Pixels</button>
                </div>
                <div class="flex justify-end">
                    <div v-if="showGrid && getTotalPixel()" class="bg-gradient-to-b from-tree-300 to-tree-600 text-white font-bold py-2 px-4 rounded-lg uppercase text-sm shadow-xl mr-5">{{ getTotalPixel() }} pixels sold</div>
                    <div v-if="account" class="bg-gradient-to-b from-tree-300 to-tree-600 text-white font-bold py-2 px-4 rounded-lg uppercase text-sm shadow-xl">
                        <div class="flex items-center">
                            <div v-if="ownedAds.length" class="flex items-center mr-2">
                                <div>{{ ownedAds.length }}</div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            </div>
                            <div>{{ truncate(account, 4, 4, 11) }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <section class="flex items-center justify-center mb-20 bg-tree-600 border-b-4 border-tree-900 h-3">
        </section>
        <section class="flex flex-col items-center justify-center mb-20">
            <div>
                <h1 class="text-tree-600 text-xl font-bold">Write the history now ! Your pixel will last forever on the blockchain !</h1>
            </div>
            <div class="mt-2">
                <span class="text-tree-600 text-xl font-bold">Multi Chain</span>
            </div>
            <div class="mt-10">
                <div class="flex">
                    <div class="pr-4">
                        <img class="h-10" src="/images/blockchain/bsc.png" />
                    </div>
                    <div class="pr-4">
                        <img class="h-10" src="/images/blockchain/polygon.png" />
                    </div>
                    <div class="pr-4">
                        <img class="h-10" src="/images/blockchain/fantom.png" />
                    </div>
                    <div class="pr-4">
                        <img class="h-10" src="/images/blockchain/avalanche.png" />
                    </div>
                    <div class="pr-4">
                        <img class="h-10" src="/images/blockchain/heco.png" />
                    </div>
                </div>
            </div>
        </section>
        <section v-bind:class="{'h-1000': showGrid}" class="flex items-center justify-center h-screen mb-10 invisible lg:visible">
            <div v-if="showGrid" class="relative w-1000 h-1000 bg-sand-800">
                <template v-for="ad in ads">
                    <ads :ad="ad"/>
                </template>
                <VueDragResize
                    v-if="showVue3DraggableResizable"
                    :isActive="activeVue3DraggableResizable"
                    :stickSize="12"
                    :x="x"
                    :y="y"
                    :w="w"
                    :h="h"
                    :minw="10"
                    :minh="10"
                    contentClass="vdr-container"
                    @activated="toggle(true)"
                    @deactivated="toggle(false)"
                    @resizing="resize"
                    @dragging="resize"
                    :parentLimitation="true"
                    :snapToGrid="true"
                    :gridX="10"
                    :gridY="10">
                    <Buy v-if="showBuy" @buyButton="buyButton" :show="isPositionAvailable" :chain="chain"/>
                </VueDragResize>
            </div>
            <div>
                <span v-if="showMetaMaskMessage" class="text-tree-300">Please install MetaMask: <a href="https://metamask.io/">https://metamask.io/</a></span>
            </div>
            <div>
                <span v-if="showNetworkUnsupportedMessage" class="text-tree-300">Network not supported</span>
            </div>
        </section>
        <Footer />
    </div>

    <modal :show="showModal" :closeable="false" @close="showModal = false">
        <button @click="showModal = false; photoPreview = false" class="absolute top-0 right-0 p-4 w-4 h-4 rounded-50 bg-tree-900 text-white flex items-center justify-center">x</button>
        <form @submit.prevent="purchase">
            <div class="grid p-5">

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="uppercase md:text-sm text-xs text-tree-900 text-light font-semibold">Title</label>
                    <input type="text" v-model="form.title" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:ring-tree-900 focus:border-transparent" v-bind:class="[form.errors.title ? 'border-red-500' : 'border-tree-900']"/>
                    <div v-if="form.errors.title" class="text-red-500">
                        {{ form.errors.title }}
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="uppercase md:text-sm text-xs text-tree-900 text-light font-semibold">Link</label>
                    <input type="url" v-model="form.link" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:ring-tree-900 focus:border-transparent" v-bind:class="[form.errors.link ? 'border-red-500' : 'border-tree-900']"/>
                    <div v-if="form.errors.link" class="text-red-500">
                        {{ form.errors.link }}
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="uppercase md:text-sm text-xs text-tree-900 text-light font-semibold mb-1">Upload Photo</label>
                    <div v-bind:class="{ 'hidden': photoPreview}" class='flex items-center justify-center w-full'>
                        <label class='flex flex-col border-4 border-dashed  w-full h-32 hover:bg-sand-400 hover:border-tree-900 group' v-bind:class="[form.errors.photo ? 'border-red-500' : 'border-tree-900']">
                            <div class='flex flex-col items-center justify-center pt-7'>
                                <svg class="w-10 h-10 text-tree-900 group-hover:text-tree-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class='lowercase text-sm text-tree-900 group-hover:text-tree-900 pt-1 tracking-wider'>Select a photo</p>
                            </div>
                            <input type='file' class="hidden" ref="photo" @change="updatePhotoPreview"/>
                        </label>
                    </div>
                    <div v-if="photoPreview" class='flex items-center justify-center w-full'>
                        <div class="relative">
                            <button @click="deletePhoto" class="absolute top-0 right-0 p-4 w-4 h-4 rounded-50 bg-tree-900 text-white flex items-center justify-center">x</button>
                            <img class="h-40" :src="photoPreview">
                        </div>
                    </div>
                    <div v-if="form.errors.photo" class="text-red-500">
                        {{ form.errors.photo }}
                    </div>
                </div>
            </div>
            <div class="flex justify-center bg-transparent">
                <button :disabled="form.processing" type="submit" class="bg-leaf-400 font-semibold text-white py-3 w-full rounded-b-md hover:bg-leaf-800 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300">
                    <span>Yes, Pixels everywhere !</span>
                </button>
            </div>
        </form>
    </modal>

</template>

<script>
    import VueDragResize from 'vue-drag-resize'
    import Ads from './Components/Ads'
    import Buy from './Components/Buy'
    import Modal from './Components/Modal'
    import Footer from './Parts/Footer'
    import Owner from './Parts/Owner'
    import Web3 from 'web3'
    import contractJSON from '../../../../solidity/build/OneMillionPixel.json'

    export default {
        components: {
            VueDragResize,
            Ads,
            Buy,
            Modal,
            Footer,
            Owner
        },
        data(){
          return {
              x: 440,
              y: 120,
              h: 40,
              w: 80,
              showVue3DraggableResizable: false,
              activeVue3DraggableResizable: false,
              showGrid: false,
              showMetaMaskMessage: false,
              showNetworkUnsupportedMessage: false,
              showBuy: false,
              showModal: false,
              account: null,
              contract: null,
              web3: null,
              chain: null,
              ads: [],
              ownedAds: [],
              total_pixels: 0,
              grid: null,
              deadAddress: '0x0000000000000000000000000000000000000000',
              isPositionAvailable: false,
              form: this.$inertia.form({
                  title: null,
                  link : null,
                  photo : null,
              }),
              photoPreview: null
          }
        },
        mounted(){
            const _this = this
            if(window.ethereum && window.web3.currentProvider.isMetaMask){
                window.ethereum.enable();
                window.ethereum.on('chainChanged', function (chainId) {
                    if(_this.$page.props.deployed.indexOf(chainId) !== -1){
                        _this.initChain(chainId)
                    }else{
                        _this.wrongChain()
                    }
                })
                window.ethereum.on('accountsChanged', function (accounts) {
                    _this.account = accounts[0]
                    _this.initChain(this.chain)
                });

                const chainId = window.web3.currentProvider.chainId
                if(this.$page.props.deployed.indexOf(chainId) !== -1) {
                    this.initChain(chainId)
                }else{
                    this.wrongChain()
                }
            }else{
                this.showMetaMaskMessage = true
            }
        },
        methods: {
            wrongChain(){
                this.showGrid = false
                this.showNetworkUnsupportedMessage = true
                this.contract = null
                this.chain = null
            },
            initChain(chainId){
                this.showGrid = true
                this.showNetworkUnsupportedMessage = false
                this.getChain(chainId)
                this.web3 = new Web3(window.web3.currentProvider)
                try {
                    this.getAccounts()
                    this.contract = new this.web3.eth.Contract(contractJSON.abi, this.chain.contract['1million'].address)
                    this.loadAds()
                    this.loadEvents()
                }catch (e) {
                    this.wrongChain()
                }
            },
            getChain(chainId){
                const _this = this
                Object.entries(this.$page.props.chains).forEach(item => {
                    const [key, value] = item;
                    if(value.id === chainId){
                        _this.chain = this.$page.props.chains[key]
                    }
                });
            },
            getAccounts() {
                const _this = this
                this.web3.eth.getAccounts(function(err, res) {
                    for (const acct of res) {
                        _this.account = acct
                    }
                })
            },
            loadEvents(){
                const _this = this
                this.total_pixels = 0
                this.contract.events.Buy(function(err, res) {
                    if(!err) {
                        const value = res.returnValues
                        _this.total_pixels += value.width * value.height * 100;
                        const idx = _this.ads.length
                        if(value.owner !== _this.deadAddress) {
                            _this.ads.push({
                                idx: idx,
                                owner: value.owner,
                                x: value.x,
                                y: value.y,
                                width: value.width,
                                height: value.height,
                                link: value.link,
                                image: value.image,
                                title: value.title,
                            })
                            if (_this.account === value.owner) {
                                _this.ownedAds.push(_this.ads[idx])
                            }
                            _this.$gtag.purchase('buy-success', {
                                transaction_id: res.transactionHash,
                                affiliation: _this.chain.token,
                                value: JSON.stringify(res.returnValues),
                                items: [
                                    {
                                        id: res.address,
                                        name: res.event,
                                    }
                                ]
                            })
                        }
                    }
                    _this.showVue3DraggableResizable = false
                    _this.toggle(false)
                    _this.showModal = false
                    _this.grid = null
                    _this.deletePhoto()
                    _this.form.reset()
                });
            },
            loadAds(){
                const _this = this
                this.ads = []
                this.ownedAds = []
                this.grid = null
                this.contract.methods.getAdsLength().call(function(err, res) {
                    const num = res;
                    for (let i=0; i<num; i++) {
                        _this.contract.methods.ads(i).call(function(err, res) {
                            if(res[0] !== _this.deadAddress) {
                                _this.total_pixels += res[3] * res[4] * 100;
                                const ad = {
                                    idx: i,
                                    owner: res[0],
                                    x: res[1],
                                    y: res[2],
                                    width: res[3],
                                    height: res[4],
                                    link: res[5],
                                    image: res[6],
                                    title: res[7],
                                }
                                _this.ads.push(ad)
                                if (_this.account === res[0]) {
                                    _this.ownedAds.push(ad)
                                }
                            }
                        })
                    }
                })
            },
            buy(){
                this.showVue3DraggableResizable = true
                this.activeVue3DraggableResizable = true;
                this.toggle(true)
            },
            buyButton(){
                this.showModal = true
            },
            toggle(state){
                this.activeVue3DraggableResizable = state
                this.showBuy = state
            },
            getTotalPixel(){
                return new Intl.NumberFormat().format(this.total_pixels)
            },
            resize(newRect) {
                this.w = newRect.width;
                this.h = newRect.height;
                this.y = newRect.top;
                this.x = newRect.left;
                this.isPositionAvailable = this.isAvailable()
            },
            updatePhotoPreview(){
                const photo = this.$refs.photo.files[0];
                if (! photo) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };
                reader.readAsDataURL(photo);
            },
            deletePhoto() {
                this.photoPreview = null;
                this.clearPhotoFileInput();
            },
            clearPhotoFileInput() {
                if (this.$refs.photo?.value) {
                    this.$refs.photo.value = null;
                }
            },
            purchase() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }
                this.form.post(this.route('purchase.store'),{
                    errorBag: 'createPurchase',
                    onSuccess: (page) => {
                        if(page?.props?.jetstream?.flash){
                            const flash = page.props.jetstream.flash
                            if(
                                flash?.title &&
                                flash?.link &&
                                flash?.image
                            ){
                                const _this = this
                                const ad = {x: this.x, y: this.y, width: this.w, height: this.h}
                                if (!this.checkAvailable(ad.x, ad.y, ad.width, ad.height)) {
                                    this.showModal = false
                                    return
                                }


                                const weiPrice = this.web3.utils.toWei(this.price(ad.width, ad.height).toString(), "ether");
                                const x = Math.floor(ad.x/10), y = Math.floor(ad.y/10), width = Math.floor(ad.width/10), height = Math.floor(ad.height/10);

                                _this.$gtag.event('buy-submit', {
                                    event_category: _this.chain.token,
                                    event_label: ad.width + "x" + ad.height,
                                    value: weiPrice
                                })

                                this.contract.methods.buy(x, y, width, height, flash.link, flash.image, flash.title).send({ value: weiPrice, from: this.account }, function(err, res) {
                                    if(err){
                                        _this.$gtag.event('buy-error', {
                                            event_category: _this.chain.token,
                                            event_label: ad.width + "x" + ad.height,
                                            value: JSON.stringify(err)
                                        })
                                    }else{
                                        _this.$gtag.event('buy-success', {
                                            event_category: _this.chain.token,
                                            event_label: ad.width + "x" + ad.height,
                                            value: weiPrice
                                        })
                                    }
                                })
                            }
                        }
                    }
                });
            },
            isAvailable() {
                return this.checkAvailable(this.x, this.y, this.w, this.h);
            },
            checkAvailable(x, y, width, height) {
                const x1 = Math.floor(x/10);
                const y1 = Math.floor(y/10);
                const x2 = x1 + Math.floor(width/10) - 1;
                const y2 = y1 + Math.floor(height/10) - 1;
                return !this.isColliding(x1, y1, x2, y2);
            },
            grid_array2d(w, h) {
                const grid = [];
                grid.length = h;

                for (let x=0; x<w; x++) {
                    const row = [];
                    row.length = w;
                    for(let y=0; y<h; y++) row[y] = 0;
                    grid[x] = row;
                }

                return {
                    set: function(x, y, value) {
                        grid[x][y] = value;
                    },
                    get: function(x, y) {
                        return grid[x][y];
                    },
                    checkBox: function(x1, y1, x2, y2) {
                        // Returns true if has collision, inclusive.
                        if (x1 < 0 || y1 < 0 || x2 >= w || y2 >= h) return true;

                        for (let x=Number(x1); x<=x2; x++) {
                            for (let y=Number(y1); y<=y2; y++) {
                                if(grid[x][y]) return true;
                            }
                        }
                        return false;
                    },
                    setBox: function(x1, y1, x2, y2) {
                        for (let x=Number(x1); x<=x2; x++) {
                            for (let y=Number(y1); y<=y2; y++) {
                                grid[x][y] = true;
                            }
                        }
                    },
                }
            },
            filledGrid(grid, ads) {
                for(let ad of ads) {
                    const x2 = Number(ad.x)+Number(ad.width)-1;
                    const y2 = Number(ad.y)+Number(ad.height)-1;
                    grid.setBox(ad.x, ad.y, x2, y2);
                }
                return grid;
            },
            isColliding(x1, y1, x2, y2) {
                if (this.grid === null) {
                    this.grid = this.filledGrid(this.grid_array2d(100, 100), this.ads);
                }
                return this.grid.checkBox(x1, y1, x2, y2);
            },
            price(height, width) {
                return Math.ceil(height * width * this.chain.contract['1million'].price_per_pixel * 100) / 100;
            },
            truncate(text, startChars, endChars, maxLength) {
                if (text.length > maxLength) {
                    var start = text.substring(0, startChars);
                    var end = text.substring(text.length - endChars, text.length);
                    while ((start.length + end.length) < maxLength)
                    {
                        start = start + '.';
                    }
                    return start + end;
                }
                return text;
            }
        },
    }
</script>
