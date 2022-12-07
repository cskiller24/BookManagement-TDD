<template>
    <section class="h-screen flex justify-center items-center flex-col">
        <img
            src="@/assets/books/email-verify.svg"
            alt="Email Verification Picture"
        />
        <section class="email-text md:w-1/3 mx-2 text-justify">
            <div class="text-header text-center mb-2">
                Email Verification Sent
            </div>
            <p>
                We have sent an email verification to click the link in the
                email to verify.
            </p>
            <p>The email will expire in 24 hours.</p>
            <form @submit.prevent method="post" class="mt-2">
                If the email did not send. Click
                <input
                    type="submit"
                    name="resend"
                    value="here"
                    :class="[timer === 0 ? activeClass : unActiveClass]"
                />
                to send another verification email
            </form>
            <div class="text-gray-500">
                <!-- TODO Implement timer -->
                You can only send an email after this is removed in (TODO)
            </div>
        </section>
    </section>
</template>
