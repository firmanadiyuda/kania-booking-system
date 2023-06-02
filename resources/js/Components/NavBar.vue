<script setup>
import DarkModeSwitcher from '@/Components/DarkModeSwitcher.vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import { initFlowbite } from 'flowbite'
import { onMounted, computed } from 'vue';
import { useStore } from 'vuex'

const store = useStore()
const page = usePage()
const user = computed(() => page.props.auth.user)

onMounted(() => {
	initFlowbite();
})

const removeFromCart = (id) => {
	store.commit('removeFromCart', id)
	// console.log(store.state.cart)
};

const logout = () => {
	router.post(route('logout'));
};

</script>

<template>
	<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
		<div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
			<Link :href="route('home')" class="flex items-center">
			<!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo"> -->
			<span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Kania Wedding</span>
			</Link>
			<div class="flex md:order-2">
				<DarkModeSwitcher />
				<!-- <button type="button"
					class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Booking Sekarang</button> -->




				<button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover"
					data-dropdown-offset-skidding="-150"
					class="ml-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
					type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
						class="fill-gray-300">
						<path
							d="M4.00436 6.41662L0.761719 3.17398L2.17593 1.75977L5.41857 5.00241H20.6603C21.2126 5.00241 21.6603 5.45012 21.6603 6.00241C21.6603 6.09973 21.6461 6.19653 21.6182 6.28975L19.2182 14.2898C19.0913 14.7127 18.7019 15.0024 18.2603 15.0024H6.00436V17.0024H17.0044V19.0024H5.00436C4.45207 19.0024 4.00436 18.5547 4.00436 18.0024V6.41662ZM6.00436 7.00241V13.0024H17.5163L19.3163 7.00241H6.00436ZM5.50436 23.0024C4.67593 23.0024 4.00436 22.3308 4.00436 21.5024C4.00436 20.674 4.67593 20.0024 5.50436 20.0024C6.33279 20.0024 7.00436 20.674 7.00436 21.5024C7.00436 22.3308 6.33279 23.0024 5.50436 23.0024ZM17.5044 23.0024C16.6759 23.0024 16.0044 22.3308 16.0044 21.5024C16.0044 20.674 16.6759 20.0024 17.5044 20.0024C18.3328 20.0024 19.0044 20.674 19.0044 21.5024C19.0044 22.3308 18.3328 23.0024 17.5044 23.0024Z">
						</path>
					</svg></button>
				<!-- Dropdown menu -->
				<div id="dropdownHover"
					class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-65 dark:bg-gray-700">
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
						<li v-for="cart in store.state.cart" class="p-2">
							<div
								class="flex max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
								<div class="mr-4">
									<img class="rounded-lg w-44" :src="cart.fotos[0].path" alt="Large avatar">
								</div>
								<div class="pr-2">
									<a href="#">
										<h5 class="py-1 text-md font-bold tracking-wide text-gray-900 dark:text-white">
											{{ (cart.nama).substring(0, 15) }}</h5>
									</a>
									<div class="flex items-center py-1">
										<span
											class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">{{
												cart.tipe }}</span>
										<span
											class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{
												cart.ukuran }}</span>
										<span
											class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 capitalize">{{
												cart.warna }}</span>

									</div>
									<div class="">
										<button type="button" @click="removeFromCart(cart.id)"
											class="flex focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1 mr-2 my-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
												height="18" class="fill-gray-300 mr-2">
												<path
													d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
												</path>
											</svg>
											Hapus</button>
									</div>
								</div>
							</div>

						</li>

						<div class="px-2 pt-4" v-if="Object.keys(store.state.cart).length !== 0">

							<Link :href="route('createFormBooking')"
								class=" flex text-white justify-center w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
							Booking Keranjang
							<svg xmlns="http://www.w3.org/2000/svg" class="ml-2" viewBox="0 0 24 24" width="18" height="18">
								<path
									d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
									class="fill-gray-200"></path>
							</svg>
							</Link>
						</div>

						<div class="p-6 py-4" v-else>
							Tidak ada item di keranjang.
						</div>

					</ul>
				</div>




				<button data-collapse-toggle="navbar-sticky" type="button"
					class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
					aria-controls="navbar-sticky" aria-expanded="false">
					<span class="sr-only">Open main menu</span>
					<svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
							clip-rule="evenodd"></path>
					</svg>
				</button>
			</div>
			<div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
				<ul
					class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
					<li>
						<Link :href="route('home')"
							class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
							:class="{ 'bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500': route().current() === 'home' }"
							aria-current="page">Home</Link>
					</li>
					<li>
						<Link :href="route('busanaList')"
							class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
							:class="{ 'bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500': route().current() === 'busanaList' }">
						Busana</Link>
						<!-- {{ route().current() }} -->
					</li>
					<li v-if="user">
						<button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
							class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Admin
							<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
									clip-rule="evenodd"></path>
							</svg></button>
						<!-- Dropdown menu -->
						<div id="dropdownNavbar"
							class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
							<ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
								<li>
									<Link :href="route('dashboard')"
										class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
									Dashboard</Link>
								</li>
								<li>
									<Link :href="route('indexBusana')"
										class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
									Busana</Link>
								</li>
								<li>
									<Link :href="route('indexBooking')"
										class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
									Booking</Link>
								</li>
							</ul>
							<div class="py-1">
								<form @submit.prevent="logout()">
									<button type="submit"
										class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Log
										out</button>
								</form>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>