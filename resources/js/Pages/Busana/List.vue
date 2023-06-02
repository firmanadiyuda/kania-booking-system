<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useStore } from 'vuex'

const store = useStore()
const props = defineProps(['busana']);

const addToCart = (payload) => {
	store.commit('addToCart', payload)
	console.log(store.state.cart)
};

const removeFromCart = (id) => {
	store.commit('removeFromCart', id)
	console.log(store.state.cart)
};
</script>
 
<template>
	<Head title="User Profile" />

	<AppLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				Daftar Busana
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div
					class="first-letter:bg-white dark:bg-gray-800 dark:bg-opacity-20 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">

					<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

						<div v-if="!busana.length"
							class="flex flex-col justify-center p-6 bg-white border-2 border-dotted border-gray-200 rounded-lg shadow dark:bg-gray-800/50 dark:border-gray-500 text-center">
							<p class="font-normal text-gray-700 dark:text-gray-400">Tidak ada busana</p>
						</div>

						<div v-for="b in busana"
							class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
							<Link :href="route('busanaShow', {id: b.id})">



								<div :id="b.id" class="relative w-full" data-carousel="slide">
									<!-- Carousel wrapper -->
									<div class="relative h-52 overflow-hidden rounded-lg">
										<!-- Item 1 -->
										<div v-for="foto in b.fotos" class="hidden duration-700 ease-in-out"
											data-carousel-item>
											<img :src="foto.path"
												class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
												alt="...">
										</div>
									</div>
									<!-- Slider indicators -->
									<div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
										<button v-for="(foto, index) in b.fotos" :key="foto.id" type="button"
											class="w-3 h-3 rounded-full" aria-current="true"
											:data-carousel-slide-to="index"></button>
									</div>
									<!-- Slider controls -->
									<button type="button"
										class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
										data-carousel-prev>
										<span
											class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
											<svg aria-hidden="true"
												class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
												stroke="currentColor" viewBox="0 0 24 24"
												xmlns="http://www.w3.org/2000/svg">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M15 19l-7-7 7-7"></path>
											</svg>
											<span class="sr-only">Previous</span>
										</span>
									</button>
									<button type="button"
										class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
										data-carousel-next>
										<span
											class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
											<svg aria-hidden="true"
												class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
												stroke="currentColor" viewBox="0 0 24 24"
												xmlns="http://www.w3.org/2000/svg">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M9 5l7 7-7 7"></path>
											</svg>
											<span class="sr-only">Next</span>
										</span>
									</button>
								</div>





							</Link>
							<div class="px-5 pb-5 mt-5">
								<Link :href="route('busanaShow', {id: b.id})">
									<h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
										{{ b.nama }}</h5>
									</Link>
								<div class="flex items-center mt-2.5 mb-5">
									<span
										class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">{{
											b.tipe }}</span>
									<span
										class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{
											b.ukuran }}</span>
									<span
										class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 capitalize">{{
											b.warna }}</span>

								</div>
								<div class="flex items-center justify-between">
									<span class="text-3xl font-bold text-gray-900 dark:text-white">Rp{{
										(b.harga).toLocaleString() }}</span>

									<button type="button" @click="addToCart(b)" v-if="!store.state.cart[b.id]"
										class="flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
											class="fill-gray-300 mr-2">
											<path
												d="M4.00436 6.41662L0.761719 3.17398L2.17593 1.75977L5.41857 5.00241H20.6603C21.2126 5.00241 21.6603 5.45012 21.6603 6.00241C21.6603 6.09973 21.6461 6.19653 21.6182 6.28975L19.2182 14.2898C19.0913 14.7127 18.7019 15.0024 18.2603 15.0024H6.00436V17.0024H17.0044V19.0024H5.00436C4.45207 19.0024 4.00436 18.5547 4.00436 18.0024V6.41662ZM6.00436 7.00241V13.0024H17.5163L19.3163 7.00241H6.00436ZM5.50436 23.0024C4.67593 23.0024 4.00436 22.3308 4.00436 21.5024C4.00436 20.674 4.67593 20.0024 5.50436 20.0024C6.33279 20.0024 7.00436 20.674 7.00436 21.5024C7.00436 22.3308 6.33279 23.0024 5.50436 23.0024ZM17.5044 23.0024C16.6759 23.0024 16.0044 22.3308 16.0044 21.5024C16.0044 20.674 16.6759 20.0024 17.5044 20.0024C18.3328 20.0024 19.0044 20.674 19.0044 21.5024C19.0044 22.3308 18.3328 23.0024 17.5044 23.0024Z">
											</path>
										</svg>
										Booking</button>

									<button type="button" @click="removeFromCart(b.id)" v-if="store.state.cart[b.id]"
										class="flex focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
											class="fill-gray-300 mr-2">
											<path
												d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
											</path>
										</svg>
										Hapus</button>


								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</AppLayout>
</template>