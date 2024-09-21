<div class="container my-3">
    <div class="row">
        <div class="col-sm-12 col-lg-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fdormitory.gif?alt=media&token=d2d8e1c5-9914-4e76-8c62-f457165f37ba" alt="" class="img-fluid">                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h1 class="page-title">Sarpras Sekolah</h1>
                                </div>
                                <div class="col-6 col-sm-4 col-xl">
                                    <x-header-success-link :href="route('school-purchases.index')" :active="request()->routeIs('school-purchases.index')" wire:navigate>
                                        {{ __('Pembelian') }}
                                    </x-header-success-link>
                                </div>
                                <div class="col-6 col-sm-4 col-xl">
                                    <x-header-warning-link :href="route('good-items-school')" :active="request()->routeIs('good-items-school')" wire:navigate>
                                        {{ __('Baik') }}
                                    </x-header-warning-link>
                                </div>
                                <div class="col-6 col-sm-4 col-xl">
                                    <x-header-danger-link :href="route('damaged-items-school')" :active="request()->routeIs('damaged-items-school')" wire:navigate>
                                        {{ __('Rusak') }}
                                    </x-header-danger-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="https://firebasestorage.googleapis.com/v0/b/explorefireb4se.appspot.com/o/Icons%2Fdormitory.gif?alt=media&token=d2d8e1c5-9914-4e76-8c62-f457165f37ba" alt="" class="img-fluid">                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h1 class="page-title">Sarpras Asrama</h1>
                                </div>
                                <div class="col-6 col-sm-4 col-xl">
                                    <x-header-success-link :href="route('dorm-purchases.index')" :active="request()->routeIs('dorm-purchases.index')" wire:navigate>
                                        {{ __('Pembelian') }}
                                    </x-header-success-link>
                                </div>
                                <div class="col-6 col-sm-4 col-xl">
                                    <x-header-warning-link :href="route('good-items-dorm')" :active="request()->routeIs('good-items-dorm')" wire:navigate>
                                        {{ __('Baik') }}
                                    </x-header-warning-link>
                                </div>
                                <div class="col-6 col-sm-4 col-xl">
                                    <x-header-danger-link :href="route('damaged-items-dorm')" :active="request()->routeIs('damaged-items-dorm')" wire:navigate>
                                        {{ __('Rusak') }}
                                    </x-header-danger-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
