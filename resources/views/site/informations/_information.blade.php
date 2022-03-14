<?php
$file = glob('storage/informations/'.$information->id.'/*.*');
?>
@if (isset($file[0]))
<a href="/{{ $file[0] }}" class="reports-docs-item">
    <div class="reports-docs-item__left">
        <div class="reports-docs-item__doc">
            <svg viewBox="0 0 18 20">
                <path fill="currentColor" d="M5.92573 14.39H11.3119C11.7178 14.39 12.0544 14.05 12.0544 13.64C12.0544 13.23 11.7178 12.9 11.3119 12.9H5.92573C5.51979 12.9 5.18316 13.23 5.18316 13.64C5.18316 14.05 5.51979 14.39 5.92573 14.39ZM9.27227 7.89999H5.92573C5.51979 7.89999 5.18316 8.23999 5.18316 8.64999C5.18316 9.05999 5.51979 9.38999 5.92573 9.38999H9.27227C9.67821 9.38999 10.0148 9.05999 10.0148 8.64999C10.0148 8.23999 9.67821 7.89999 9.27227 7.89999ZM16.3381 7.02561C16.5708 7.02292 16.8242 7.02 17.0545 7.02C17.302 7.02 17.5 7.22 17.5 7.47V15.51C17.5 17.99 15.5099 20 13.0545 20H5.17327C2.59901 20 0.5 17.89 0.5 15.29V4.51C0.5 2.03 2.5 0 4.96535 0H10.2525C10.5099 0 10.7079 0.21 10.7079 0.46V3.68C10.7079 5.51 12.203 7.01 14.0149 7.02C14.4381 7.02 14.8112 7.02316 15.1377 7.02593C15.3917 7.02809 15.6175 7.03 15.8168 7.03C15.9578 7.03 16.1405 7.02789 16.3381 7.02561ZM16.6111 5.566C15.7972 5.569 14.8378 5.566 14.1477 5.559C13.0527 5.559 12.1507 4.64799 12.1507 3.542V0.905995C12.1507 0.474995 12.6685 0.260995 12.9645 0.571995C13.5004 1.13473 14.2368 1.90826 14.9697 2.67825C15.7008 3.44624 16.4286 4.21071 16.9507 4.759C17.2398 5.062 17.0279 5.565 16.6111 5.566Z"/>
            </svg>
        </div>
        <span class="reports-docs-item__date">{{ $information->title }}</span>
    </div>
    <div class="reports-docs-item__save">
        <svg viewBox="0 0 20 19">
            <path fill="currentColor" d="M9.2301 4.79052V0.781505C9.2301 0.355229 9.5701 0 10.0001 0C10.3851 0 10.7113 0.298491 10.763 0.67658L10.7701 0.781505V4.79052L15.55 4.79083C17.93 4.79083 19.8853 6.73978 19.9951 9.17041L20 9.38609V14.4254C20 16.873 18.1127 18.8822 15.768 18.995L15.56 19H4.44C2.06 19 0.11409 17.0608 0.00483778 14.6213L0 14.4047L0 9.37576C0 6.9281 1.87791 4.90921 4.22199 4.79585L4.43 4.79083H9.23V11.1932L7.63 9.54099C7.33 9.23119 6.84 9.23119 6.54 9.54099C6.39 9.69588 6.32 9.90241 6.32 10.1089C6.32 10.2659 6.3648 10.4295 6.45952 10.5679L6.54 10.6666L9.45 13.6819C9.59 13.8368 9.79 13.9194 10 13.9194C10.1667 13.9194 10.3333 13.862 10.4653 13.7533L10.54 13.6819L13.45 10.6666C13.75 10.3568 13.75 9.85078 13.45 9.54099C13.1773 9.25936 12.7475 9.23375 12.4462 9.46418L12.36 9.54099L10.77 11.1932V4.79083L9.2301 4.79052Z"/>
        </svg>
    </div>
</a>
@endif
