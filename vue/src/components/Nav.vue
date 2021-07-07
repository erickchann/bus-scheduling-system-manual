<template>
    <div>
        <nav class="navbar navbar-expand navbar-light bg-light">
        <a class="navbar-brand" href="#">BAMRI</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link class="nav-link" to="/bus">Bus</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/driver">Driver</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/order">Order</router-link>
                </li>
            </ul>
        </div>
    </nav>
    </div>
</template>