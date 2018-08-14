<template>
	<div class="container">
		<div class="row">
			<div v-for="p in photos" class="col-md-4 card" v-bind:id="p.id_fb">
				<!--Card image-->
				<img v-img v-bind:src="p.full_picture" v-bind:alt="p.name_fb" width="350px" class="card-img-top">
				<!-- Card content -->
				<br>
				<div>
				    <!-- Title -->
				    <a class="hide-p" :href="urlFB(p.id_fb)" target="_blank">
				    	<img class="circle float-left" :src="imageFB(p.id_fb)" width="50px" alt="" aria-label="" role="img">
				    </a>
					<p class="float-left" style="padding-left:20px;line-height:50px">
						<a class="hide-p" :href="urlFB(p.id_fb)" target="_blank">{{p.name_fb}}</a>
					</p><br><br><br>
				    <!-- Text -->
				    <p class="card-text"><a class="hide-a" :href="p.link" target="_blank">{{ p.message }}</a></p>        
				</div>
				<br>
			</div>

			<infinite-loading @infinite="infiniteHandler">
				<span slot="no-more">
					Can't get photo
				</span>
			</infinite-loading>
			<!-- <infinite-loading @infinite="infiniteHandler"></infinite-loading> -->
		</div>
	</div>
</template>

<style type="text/css">
	
</style>

<script type="text/javascript">
	import InfiniteLoading from 'vue-infinite-loading';
	export default {
		data(){
            return {
                photos:{},
            }
        },
        created(){
            this.getPhotos();
        },
		methods: {
			getPhotos: function() {
				axios.get('/photos')
            	.then((response) => this.photos = response.data.photos)
            	.catch((error) => console.log(error));
			},
			urlFB: function(id) {
				return 'https://facebook.com/' + id;
		    },
		    imageFB: function(id) {
		    	return 'https://graph.facebook.com/' + id + '/picture?type=large'
		    },
		    infiniteHandler: function($state) {
		    	let limit = this.photos.length + 6;
		    	axios.get('/photos', { params: { limit: limit } })
		    	.then(response => {
		    		this.loadMore($state, response);
		    	});
		    },
		    loadMore: function($state, response) {
		    	if (response.data.photos.length) {
		    		this.photos = response.data.photos;
		    		setTimeout(() => {
			    		$state.loaded();
			    	} ,2000);

			    	if (response.data.total == this.photos.length) {
			    		$state.complete();
			    	}
		    	} else {
		    		$state.complete();
		    	}
		    }
		},
		computed : {

		},
		mounted() {
            
        },
        components: {
    		InfiniteLoading,
  		},
	};
</script>