<!-- This view type is only for nesting views -->

<template>
    <Suspense>
        <template #default><router-view></router-view></template>
        <template #fallback> Loading </template>
    </Suspense>
</template>
