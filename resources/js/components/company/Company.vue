<template>
    <div>
        <baner-component></baner-component>
		<main id="tg-main" class="tg-main tg-haslayout">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div id="tg-content" class="tg-content">
							<div class="tg-tourbookingdetail">
								<filter-component></filter-component>
								<div class="tg-sectionspace tg-haslayout">
									<detail-component
										:company="company"></detail-component>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
    </div>
</template>

<script>
	import { get } from '../../helpers/api.js'
    import Banner from './Banner.vue'
    import Filter from './Filter.vue'
    import Detail from './Detail.vue'

    export default {
		data: function () {
			return {
				id: '',
                company: {},
                errors: []
			}
		},
        created() {
			this.id = this.$route.params.id;
			this.getCompany();
        },
        components: {
            banerComponent: Banner,
            filterComponent: Filter,
            detailComponent: Detail
		},
		methods: {
			getCompany: function() {
				get(`company/${this.id}`)
					.then(response => {
						this.company = response.data.company;
					})
					.catch(e => {
						this.errors.push(e);
					})
			}
		}
    }
</script>
