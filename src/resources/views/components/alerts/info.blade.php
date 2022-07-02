<div {{ $attributes->class(['alert alert-info', 'alert-important' => $important]) }}>
    <svg xmlns="http://www.w3.org/2000/svg"
         class="icon icon-tabler icon-tabler-exclamation-mark"
         width="24"
         height="24"
         viewBox="0 0 24 24"
         stroke-width="1"
         stroke="currentColor"
         fill="none"
         stroke-linecap="round"
         stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M12 19v.01"></path>
        <path d="M12 15v-10"></path>
    </svg>
    {{ $message }}
</div>
