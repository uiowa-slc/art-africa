/*jshint undef: true */
/*global jQuery: true */

/*
   --------------------------------
   Infinite Scroll
   --------------------------------
   + https://github.com/paulirish/infinite-scroll
   + version 2.0b2.120519
   + Copyright 2011/12 Paul Irish & Luke Shumard
   + Licensed under the MIT license

   + Documentation: http://infinite-scroll.com/
*/

(function (window, $, undefined) {
	"use strict";

    $.infinitescroll = function infscr(options, callback, element) {
        this.element = $(element);

        // Flag the object in the event of a failed creation
        if (!this._create(options, callback)) {
            this.failed = true;
        }
    };

    $.infinitescroll.defaults = {
        loading: {
            finished: undefined,
            finishedMsg: "<em>Congratulations, you've reached the end of the internet.</em>",
			img: "data:image/gif;base64,R0lGODlh3AATAPQeAPDy+MnQ6LW/4N3h8MzT6rjC4sTM5r/I5NHX7N7j8c7U6tvg8OLl8uXo9Ojr9b3G5MfP6Ovu9tPZ7PT1+vX2+tbb7vf4+8/W69jd7rC73vn5/O/x+K243ai02////wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQECgD/ACwAAAAA3AATAAAF/6AnjmRpnmiqrmzrvnAsz3Rt33iu73zv/8CgcEj0BAScpHLJbDqf0Kh0Sq1ar9isdioItAKGw+MAKYMFhbF63CW438f0mg1R2O8EuXj/aOPtaHx7fn96goR4hmuId4qDdX95c4+RBIGCB4yAjpmQhZN0YGYGXitdZBIVGAsLoq4BBKQDswm1CQRkcG6ytrYKubq8vbfAcMK9v7q7EMO1ycrHvsW6zcTKsczNz8HZw9vG3cjTsMIYqQkCLBwHCgsMDQ4RDAYIqfYSFxDxEfz88/X38Onr16+Bp4ADCco7eC8hQYMAEe57yNCew4IVBU7EGNDiRn8Z831cGLHhSIgdFf9chIeBg7oA7gjaWUWTVQAGE3LqBDCTlc9WOHfm7PkTqNCh54rePDqB6M+lR536hCpUqs2gVZM+xbrTqtGoWqdy1emValeXKzggYBBB5y1acFNZmEvXAoN2cGfJrTv3bl69Ffj2xZt3L1+/fw3XRVw4sGDGcR0fJhxZsF3KtBTThZxZ8mLMgC3fRatCbYMNFCzwLEqLgE4NsDWs/tvqdezZf13Hvk2A9Szdu2X3pg18N+68xXn7rh1c+PLksI/Dhe6cuO3ow3NfV92bdArTqC2Ebd3A8vjf5QWfH6Bg7Nz17c2fj69+fnq+8N2Lty+fuP78/eV2X13neIcCeBRwxorbZrA1ANoCDGrgoG8RTshahQ9iSKEEzUmYIYfNWViUhheCGJyIP5E4oom7WWjgCeBFAJNv1DVV01MAdJhhjdkplWNzO/5oXI846njjVEIqR2OS2B1pE5PVscajkxhMycqLJghQSwT40PgfAl4GqNSXYdZXJn5gSkmmmmJu1aZYb14V51do+pTOCmA40AqVCIhG5IJ9PvYnhIFOxmdqhpaI6GeHCtpooisuutmg+Eg62KOMKuqoTaXgicQWoIYq6qiklmoqFV0UoeqqrLbq6quwxirrrLTWauutJ4QAACH5BAUKABwALAcABADOAAsAAAX/IPd0D2dyRCoUp/k8gpHOKtseR9yiSmGbuBykler9XLAhkbDavXTL5k2oqFqNOxzUZPU5YYZd1XsD72rZpBjbeh52mSNnMSC8lwblKZGwi+0QfIJ8CncnCoCDgoVnBHmKfByGJimPkIwtiAeBkH6ZHJaKmCeVnKKTHIihg5KNq4uoqmEtcRUtEREMBggtEr4QDrjCuRC8h7/BwxENeicSF8DKy82pyNLMOxzWygzFmdvD2L3P0dze4+Xh1Arkyepi7dfFvvTtLQkZBC0T/FX3CRgCMOBHsJ+EHYQY7OinAGECgQsB+Lu3AOK+CewcWjwxQeJBihtNGHSoQOE+iQ3//4XkwBBhRZMcUS6YSXOAwIL8PGqEaSJCiYt9SNoCmnJPAgUVLChdaoFBURN8MAzl2PQphwQLfDFd6lTowglHve6rKpbjhK7/pG5VinZP1qkiz1rl4+tr2LRwWU64cFEihwEtZgbgR1UiHaMVvxpOSwBA37kzGz9e8G+B5MIEKLutOGEsAH2ATQwYfTmuX8aETWdGPZmiZcccNSzeTCA1Sw0bdiitC7LBWgu8jQr8HRzqgpK6gX88QbrB14z/kF+ELpwB8eVQj/JkqdylAudji/+ts3039vEEfK8Vz2dlvxZKG0CmbkKDBvllRd6fCzDvBLKBDSCeffhRJEFebFk1k/Mv9jVIoIJZSeBggwUaNeB+Qk34IE0cXlihcfRxkOAJFFhwGmKlmWDiakZhUJtnLBpnWWcnKaAZcxI0piFGGLBm1mc90kajSCveeBVWKeYEoU2wqeaQi0PetoE+rr14EpVC7oAbAUHqhYExbn2XHHsVqbcVew9tx8+XJKk5AZsqqdlddGpqAKdbAYBn1pcczmSTdWvdmZ17c1b3FZ99vnTdCRFM8OEcAhLwm1NdXnWcBBSMRWmfkWZqVlsmLIiAp/o1gGV2vpS4lalGYsUOqXrddcKCmK61aZ8SjEpUpVFVoCpTj4r661Km7kBHjrDyc1RAIQAAIfkEBQoAGwAsBwAEAM4ACwAABf/gtmUCd4goQQgFKj6PYKi0yrrbc8i4ohQt12EHcal+MNSQiCP8gigdz7iCioaCIvUmZLp8QBzW0EN2vSlCuDtFKaq4RyHzQLEKZNdiQDhRDVooCwkbfm59EAmKi4SGIm+AjIsKjhsqB4mSjT2IOIOUnICeCaB/mZKFNTSRmqVpmJqklSqskq6PfYYCDwYHDC4REQwGCBLGxxIQDsHMwhAIX8bKzcENgSLGF9PU1j3Sy9zX2NrgzQziChLk1BHWxcjf7N046tvN82715czn9Pryz6Ilc4ACj4EBOCZM8KEnAYYADBRKnACAYUMFv1wotIhCEcaJCisqwJFgAUSQGyX/kCSVUUTIdKMwJlyo0oXHlhskwrTJciZHEXsgaqS4s6PJiCAr1uzYU8kBBSgnWFqpoMJMUjGtDmUwkmfVmVypakWhEKvXsS4nhLW5wNjVroJIoc05wSzTr0PtiigpYe4EC2vj4iWrFu5euWIMRBhacaVJhYQBEFjA9jHjyQ0xEABwGceGAZYjY0YBOrRLCxUp29QM+bRkx5s7ZyYgVbTqwwti2ybJ+vLtDYpycyZbYOlptxdx0kV+V7lC5iJAyyRrwYKxAdiz82ng0/jnAdMJFz0cPi104Ec1Vj9/M6F173vKL/feXv156dw11tlqeMMnv4V5Ap53GmjQQH97nFfg+IFiucfgRX5Z8KAgbUlQ4IULIlghhhdOSB6AgX0IVn8eReghen3NRIBsRgnH4l4LuEidZBjwRpt6NM5WGwoW0KSjCwX6yJSMab2GwwAPDXfaBCtWpluRTQqC5JM5oUZAjUNS+VeOLWpJEQ7VYQANW0INJSZVDFSnZphjSikfmzE5N4EEbQI1QJmnWXCmHulRp2edwDXF43txukenJwvI9xyg9Q26Z3MzGUcBYFEChZh6DVTq34AU8Iflh51Sd+CnKFYQ6mmZkhqfBKfSxZWqA9DZanWjxmhrWwi0qtCrt/43K6WqVjjpmhIqgEGvculaGKklKstAACEAACH5BAUKABwALAcABADOAAsAAAX/ICdyQmaMYyAUqPgIBiHPxNpy79kqRXH8wAPsRmDdXpAWgWdEIYm2llCHqjVHU+jjJkwqBTecwItShMXkEfNWSh8e1NGAcLgpDGlRgk7EJ/6Ae3VKfoF/fDuFhohVeDeCfXkcCQqDVQcQhn+VNDOYmpSWaoqBlUSfmowjEA+iEAEGDRGztAwGCDcXEA60tXEiCrq8vREMEBLIyRLCxMWSHMzExnbRvQ2Sy7vN0zvVtNfU2tLY3rPgLdnDvca4VQS/Cpk3ABwSLQkYAQwT/P309vcI7OvXr94jBQMJ/nskkGA/BQBRLNDncAIAiDcG6LsxAWOLiQzmeURBKWSLCQbv/1F0eDGinJUKR47YY1IEgQASKk7Yc7ACRwZm7mHweRJoz59BJUogisKCUaFMR0x4SlJBVBFTk8pZivTR0K73rN5wqlXEAq5Fy3IYgHbEzQ0nLy4QSoCjXLoom96VOJEeCosK5n4kkFfqXjl94wa+l1gvAcGICbewAOAxY8l/Ky/QhAGz4cUkGxu2HNozhwMGBnCUqUdBg9UuW9eUynqSwLHIBujePef1ZGQZXcM+OFuEBeBhi3OYgLyqcuaxbT9vLkf4SeqyWxSQpKGB2gQpm1KdWbu72rPRzR9Ne2Nu9Kzr/1Jqj0yD/fvqP4aXOt5sW/5qsXXVcv1Nsp8IBUAmgswGF3llGgeU1YVXXKTN1FlhWFXW3gIE+DVChApysACHHo7Q4A35lLichh+ROBmLKAzgYmYEYDAhCgxKGOOMn4WR4kkDaoBBOxJtdNKQxFmg5JIWIBnQc07GaORfUY4AEkdV6jHlCEISSZ5yTXpp1pbGZbkWmcuZmQCaE6iJ0FhjMaDjTMsgZaNEHFRAQVp3bqXnZED1qYcECOz5V6BhSWCoVJQIKuKQi2KFKEkEFAqoAo7uYSmO3jk61wUUMKmknJ4SGimBmAa0qVQBhAAAIfkEBQoAGwAsBwAEAM4ACwAABf/gJm5FmRlEqhJC+bywgK5pO4rHI0D3pii22+Mg6/0Ej96weCMAk7cDkXf7lZTTnrMl7eaYoy10JN0ZFdco0XAuvKI6qkgVFJXYNwjkIBcNBgR8TQoGfRsJCRuCYYQQiI+ICosiCoGOkIiKfSl8mJkHZ4U9kZMbKaI3pKGXmJKrngmug4WwkhA0lrCBWgYFCCMQFwoQDRHGxwwGCBLMzRLEx8iGzMMO0cYNeCMKzBDW19lnF9DXDIY/48Xg093f0Q3s1dcR8OLe8+Y91OTv5wrj7o7B+7VNQqABIoRVCMBggsOHE36kSoCBIcSH3EbFangxogJYFi8CkJhqQciLJEf/LDDJEeJIBT0GsOwYUYJGBS0fjpQAMidGmyVP6sx4Y6VQhzs9VUwkwqaCCh0tmKoFtSMDmBOf9phg4SrVrROuasRQAaxXpVUhdsU6IsECZlvX3kwLUWzRt0BHOLTbNlbZG3vZinArge5Dvn7wbqtQkSYAAgtKmnSsYKVKo2AfW048uaPmG386i4Q8EQMBAIAnfB7xBxBqvapJ9zX9WgRS2YMpnvYMGdPK3aMjt/3dUcNI4blpj7iwkMFWDXDvSmgAlijrt9RTR78+PS6z1uAJZIe93Q8g5zcsWCi/4Y+C8bah5zUv3vv89uft30QP23punGCx5954oBBwnwYaNCDY/wYrsYeggnM9B2Fpf8GG2CEUVWhbWAtGouEGDy7Y4IEJVrbSiXghqGKIo7z1IVcXIkKWWR361QOLWWnIhwERpLaaCCee5iMBGJQmJGyPFTnbkfHVZGRtIGrg5HALEJAZbu39BuUEUmq1JJQIPtZilY5hGeSWsSk52G9XqsmgljdIcABytq13HyIM6RcUA+r1qZ4EBF3WHWB29tBgAzRhEGhig8KmqKFv8SeCeo+mgsF7YFXa1qWSbkDpom/mqR1PmHCqJ3fwNRVXjC7S6CZhFVCQ2lWvZiirhQq42SACt25IK2hv8TprriUV1usGgeka7LFcNmCldMLi6qZMgFLgpw16Cipb7bC1knXsBiEAACH5BAUKABsALAcABADOAAsAAAX/4FZsJPkUmUGsLCEUTywXglFuSg7fW1xAvNWLF6sFFcPb42C8EZCj24EJdCp2yoegWsolS0Uu6fmamg8n8YYcLU2bXSiRaXMGvqV6/KAeJAh8VgZqCX+BexCFioWAYgqNi4qAR4ORhRuHY408jAeUhAmYYiuVlpiflqGZa5CWkzc5fKmbbhIpsAoQDRG8vQwQCBLCwxK6vb5qwhfGxxENahvCEA7NzskSy7vNzzzK09W/PNHF1NvX2dXcN8K55cfh69Luveol3vO8zwi4Yhj+AQwmCBw4IYclDAAJDlQggVOChAoLKkgFkSCAHDwWLKhIEOONARsDKryogFPIiAUb/95gJNIiw4wnI778GFPhzBKFOAq8qLJEhQpiNArjMcHCmlTCUDIouTKBhApELSxFWiGiVKY4E2CAekPgUphDu0742nRrVLJZnyrFSqKQ2ohoSYAMW6IoDpNJ4bLdILTnAj8KUF7UeENjAKuDyxIgOuGiOI0EBBMgLNew5AUrDTMGsFixwBIaNCQuAXJB57qNJ2OWm2Aj4skwCQCIyNkhhtMkdsIuodE0AN4LJDRgfLPtn5YDLdBlraAByuUbBgxQwICxMOnYpVOPej074OFdlfc0TqC62OIbcppHjV4o+LrieWhfT8JC/I/T6W8oCl29vQ0XjLdBaA3s1RcPBO7lFvpX8BVoG4O5jTXRQRDuJ6FDTzEWF1/BCZhgbyAKE9qICYLloQYOFtahVRsWYlZ4KQJHlwHS/IYaZ6sZd9tmu5HQm2xi1UaTbzxYwJk/wBF5g5EEYOBZeEfGZmNdFyFZmZIR4jikbLThlh5kUUVJGmRT7sekkziRWUIACABk3T4qCsedgO4xhgGcY7q5pHJ4klBBTQRJ0CeHcoYHHUh6wgfdn9uJdSdMiebGJ0zUPTcoS286FCkrZxnYoYYKWLkBowhQoBeaOlZAgVhLidrXqg2GiqpQpZ4apwSwRtjqrB3muoF9BboaXKmshlqWqsWiGt2wphJkQbAU5hoCACH5BAUKABsALAcABADOAAsAAAX/oGFw2WZuT5oZROsSQnGaKjRvilI893MItlNOJ5v5gDcFrHhKIWcEYu/xFEqNv6B1N62aclysF7fsZYe5aOx2yL5aAUGSaT1oTYMBwQ5VGCAJgYIJCnx1gIOBhXdwiIl7d0p2iYGQUAQBjoOFSQR/lIQHnZ+Ue6OagqYzSqSJi5eTpTxGcjcSChANEbu8DBAIEsHBChe5vL13G7fFuscRDcnKuM3H0La3EA7Oz8kKEsXazr7Cw9/Gztar5uHHvte47MjktznZ2w0G1+D3BgirAqJmJMAQgMGEgwgn5Ei0gKDBhBMALGRYEOJBb5QcWlQo4cbAihZz3GgIMqFEBSM1/4ZEOWPAgpIIJXYU+PIhRG8ja1qU6VHlzZknJNQ6UanCjQkWCIGSUGEjAwVLjc44+DTqUQtPPS5gejUrTa5TJ3g9sWCr1BNUWZI161StiQUDmLYdGfesibQ3XMq1OPYthrwuA2yU2LBs2cBHIypYQPPlYAKFD5cVvNPtW8eVGbdcQADATsiNO4cFAPkvHpedPzc8kUcPgNGgZ5RNDZG05reoE9s2vSEP79MEGiQGy1qP8LA4ZcdtsJE48ONoLTBtTV0B9LsTnPceoIDBDQvS7W7vfjVY3q3eZ4A339J4eaAmKqU/sV58HvJh2RcnIBsDUw0ABqhBA5aV5V9XUFGiHfVeAiWwoFgJJrIXRH1tEMiDFV4oHoAEGlaWhgIGSGBO2nFomYY3mKjVglidaNYJGJDkWW2xxTfbjCbVaOGNqoX2GloR8ZeTaECS9pthRGJH2g0b3Agbk6hNANtteHD2GJUucfajCQBy5OOTQ25ZgUPvaVVQmbKh9510/qQpwXx3SQdfk8tZJOd5b6JJFplT3ZnmmX3qd5l1eg5q00HrtUkUn0AKaiGjClSAgKLYZcgWXwocGRcCFGCKwSB6ceqphwmYRUFYT/1WKlOdUpipmxW0mlCqHjYkAaeoZlqrqZ4qd+upQKaapn/AmgAegZ8KUtYtFAQQAgAh+QQFCgAbACwHAAQAzgALAAAF/+C2PUcmiCiZGUTrEkKBis8jQEquKwU5HyXIbEPgyX7BYa5wTNmEMwWsSXsqFbEh8DYs9mrgGjdK6GkPY5GOeU6ryz7UFopSQEzygOGhJBjoIgMDBAcBM0V/CYqLCQqFOwobiYyKjn2TlI6GKC2YjJZknouaZAcQlJUHl6eooJwKooobqoewrJSEmyKdt59NhRKFMxLEEA4RyMkMEAjDEhfGycqAG8TQx9IRDRDE3d3R2ctD1RLg0ttKEnbY5wZD3+zJ6M7X2RHi9Oby7u/r9g38UFjTh2xZJBEBMDAboogAgwkQI07IMUORwocSJwCgWDFBAIwZOaJIsOBjRogKJP8wTODw5ESVHVtm3AhzpEeQElOuNDlTZ0ycEUWKWFASqEahGwYUPbnxoAgEdlYSqDBkgoUNClAlIHbSAoOsqCRQnQHxq1axVb06FWFxLIqyaze0Tft1JVqyE+pWXMD1pF6bYl3+HTqAWNW8cRUFzmih0ZAAB2oGKukSAAGGRHWJgLiR6AylBLpuHKKUMlMCngMpDSAa9QIUggZVVvDaJobLeC3XZpvgNgCmtPcuwP3WgmXSq4do0DC6o2/guzcseECtUoO0hmcsGKDgOt7ssBd07wqesAIGZC1YIBa7PQHvb1+SFo+++HrJSQfB33xfav3i5eX3Hnb4CTJgegEq8tH/YQEOcIJzbm2G2EoYRLgBXFpVmFYDcREV4HIcnmUhiGBRouEMJGJGzHIspqgdXxK0yCKHRNXoIX4uorCdTyjkyNtdPWrA4Up82EbAbzMRxxZRR54WXVLDIRmRcag5d2R6ugl3ZXzNhTecchpMhIGVAKAYpgJjjsSklBEd99maZoo535ZvdamjBEpusJyctg3h4X8XqodBMx0tiNeg/oGJaKGABpogS40KSqiaEgBqlQWLUtqoVQnytekEjzo0hHqhRorppOZt2p923M2AAV+oBtpAnnPNoB6HaU6mAAIU+IXmi3j2mtFXuUoHKwXpzVrsjcgGOauKEjQrwq157hitGq2NoWmjh7z6Wmxb0m5w66+2VRAuXN/yFUAIACH5BAUKABsALAcABADOAAsAAAX/4CZuRiaM45MZqBgIRbs9AqTcuFLE7VHLOh7KB5ERdjJaEaU4ClO/lgKWjKKcMiJQ8KgumcieVdQMD8cbBeuAkkC6LYLhOxoQ2PF5Ys9PKPBMen17f0CCg4VSh32JV4t8jSNqEIOEgJKPlkYBlJWRInKdiJdkmQlvKAsLBxdABA4RsbIMBggtEhcQsLKxDBC2TAS6vLENdJLDxMZAubu8vjIbzcQRtMzJz79S08oQEt/guNiyy7fcvMbh4OezdAvGrakLAQwyABsELQkY9BP+//ckyPDD4J9BfAMh1GsBoImMeQUN+lMgUJ9CiRMa5msxoB9Gh/o8GmxYMZXIgxtR/yQ46S/gQAURR0pDwYDfywoyLPip5AdnCwsMFPBU4BPFhKBDi444quCmDKZOfwZ9KEGpCKgcN1jdALSpPqIYsabS+nSqvqplvYqQYAeDPgwKwjaMtiDl0oaqUAyo+3TuWwUAMPpVCfee0cEjVBGQq2ABx7oTWmQk4FglZMGN9fGVDMCuiH2AOVOu/PmyxM630gwM0CCn6q8LjVJ8GXvpa5Uwn95OTC/nNxkda1/dLSK475IjCD6dHbK1ZOa4hXP9DXs5chJ00UpVm5xo2qRpoxptwF2E4/IbJpB/SDz9+q9b1aNfQH08+p4a8uvX8B53fLP+ycAfemjsRUBgp1H20K+BghHgVgt1GXZXZpZ5lt4ECjxYR4ScUWiShEtZqBiIInRGWnERNnjiBglw+JyGnxUmGowsyiiZg189lNtPGACjV2+S9UjbU0JWF6SPvEk3QZEqsZYTk3UAaRSUnznJI5LmESCdBVSyaOWUWLK4I5gDUYVeV1T9l+FZClCAUVA09uSmRHBCKAECFEhW51ht6rnmWBXkaR+NjuHpJ40D3DmnQXt2F+ihZxlqVKOfQRACACH5BAUKABwALAcABADOAAsAAAX/ICdyUCkUo/g8mUG8MCGkKgspeC6j6XEIEBpBUeCNfECaglBcOVfJFK7YQwZHQ6JRZBUqTrSuVEuD3nI45pYjFuWKvjjSkCoRaBUMWxkwBGgJCXspQ36Bh4EEB0oKhoiBgyNLjo8Ki4QElIiWfJqHnISNEI+Ql5J9o6SgkqKkgqYihamPkW6oNBgSfiMMDQkGCBLCwxIQDhHIyQwQCGMKxsnKVyPCF9DREQ3MxMPX0cu4wt7J2uHWx9jlKd3o39MiuefYEcvNkuLt5O8c1ePI2tyELXGQwoGDAQf+iEC2xByDCRAjTlAgIUWCBRgCPJQ4AQBFXAs0coT40WLIjRxL/47AcHLkxIomRXL0CHPERZkpa4q4iVKiyp0tR/7kwHMkTUBBJR5dOCEBAVcKKtCAyOHpowXCpk7goABqBZdcvWploACpBKkpIJI1q5OD2rIWE0R1uTZu1LFwbWL9OlKuWb4c6+o9i3dEgw0RCGDUG9KlRw56gDY2qmCByZBaASi+TACA0TucAaTteCcy0ZuOK3N2vJlx58+LRQyY3Xm0ZsgjZg+oPQLi7dUcNXi0LOJw1pgNtB7XG6CBy+U75SYfPTSQAgZTNUDnQHt67wnbZyvwLgKiMN3oCZB3C76tdewpLFgIP2C88rbi4Y+QT3+8S5USMICZXWj1pkEDeUU3lOYGB3alSoEiMIjgX4WlgNF2EibIwQIXauWXSRg2SAOHIU5IIIMoZkhhWiJaiFVbKo6AQEgQXrTAazO1JhkBrBG3Y2Y6EsUhaGn95hprSN0oWpFE7rhkeaQBchGOEWnwEmc0uKWZj0LeuNV3W4Y2lZHFlQCSRjTIl8uZ+kG5HU/3sRlnTG2ytyadytnD3HrmuRcSn+0h1dycexIK1KCjYaCnjCCVqOFFJTZ5GkUUjESWaUIKU2lgCmAKKQIUjHapXRKE+t2og1VgankNYnohqKJ2CmKplso6GKz7WYCgqxeuyoF8u9IQAgA7",
            msg: null,
            msgText: "<em>Loading the next set of posts...</em>",
            selector: null,
            speed: 'fast',
            start: undefined
        },
        state: {
            isDuringAjax: false,
            isInvalidPage: false,
            isDestroyed: false,
            isDone: false, // For when it goes all the way through the archive.
            isPaused: false,
            isBeyondMaxPage: false,
            currPage: 1
        },
        debug: false,
		behavior: undefined,
        binder: $(window), // used to cache the selector
        nextSelector: "div.navigation a:first",
        navSelector: "div.navigation",
        contentSelector: null, // rename to pageFragment
        extraScrollPx: 150,
        itemSelector: "div.post",
        animate: false,
        pathParse: undefined,
        dataType: 'html',
        appendCallback: true,
        bufferPx: 40,
        errorCallback: function () { },
        infid: 0, //Instance ID
        pixelsFromNavToBottom: undefined,
        path: undefined, // Either parts of a URL as an array (e.g. ["/page/", "/"] or a function that takes in the page number and returns a URL
		prefill: false, // When the document is smaller than the window, load data until the document is larger or links are exhausted
        maxPage: undefined // to manually control maximum page (when maxPage is undefined, maximum page limitation is not work)
	};

    $.infinitescroll.prototype = {

        /*	
            ----------------------------
            Private methods
            ----------------------------
            */

        // Bind or unbind from scroll
        _binding: function infscr_binding(binding) {

            var instance = this,
            opts = instance.options;

            opts.v = '2.0b2.120520';

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_binding_'+opts.behavior] !== undefined) {
                this['_binding_'+opts.behavior].call(this);
                return;
            }

            if (binding !== 'bind' && binding !== 'unbind') {
                this._debug('Binding value  ' + binding + ' not valid');
                return false;
            }

            if (binding === 'unbind') {
                (this.options.binder).unbind('smartscroll.infscr.' + instance.options.infid);
            } else {
                (this.options.binder)[binding]('smartscroll.infscr.' + instance.options.infid, function () {
                    instance.scroll();
                });
            }

            this._debug('Binding', binding);
        },

        // Fundamental aspects of the plugin are initialized
        _create: function infscr_create(options, callback) {

            // Add custom options to defaults
            var opts = $.extend(true, {}, $.infinitescroll.defaults, options);
			this.options = opts;
			var $window = $(window);
			var instance = this;

			// Validate selectors
            if (!instance._validate(options)) {
				return false;
			}

            // Validate page fragment path
            var path = $(opts.nextSelector).attr('href');
            if (!path) {
                this._debug('Navigation selector not found');
                return false;
            }

            // Set the path to be a relative URL from root.
            opts.path = opts.path || this._determinepath(path);

            // contentSelector is 'page fragment' option for .load() / .ajax() calls
            opts.contentSelector = opts.contentSelector || this.element;

            // loading.selector - if we want to place the load message in a specific selector, defaulted to the contentSelector
            opts.loading.selector = opts.loading.selector || opts.contentSelector;

            // Define loading.msg
            opts.loading.msg = opts.loading.msg || $('<div id="infscr-loading"><img alt="Loading..." src="' + opts.loading.img + '" /><div>' + opts.loading.msgText + '</div></div>');

            // Preload loading.img
            (new Image()).src = opts.loading.img;

            // distance from nav links to bottom
            // computed as: height of the document + top offset of container - top offset of nav link
            if(opts.pixelsFromNavToBottom === undefined) {
				opts.pixelsFromNavToBottom = $(document).height() - $(opts.navSelector).offset().top;
				this._debug("pixelsFromNavToBottom: " + opts.pixelsFromNavToBottom);
			}

			var self = this;

            // determine loading.start actions
            opts.loading.start = opts.loading.start || function() {
                $(opts.navSelector).hide();
                opts.loading.msg
                .appendTo(opts.loading.selector)
                .show(opts.loading.speed, $.proxy(function() {
					this.beginAjax(opts);
				}, self));
            };

            // determine loading.finished actions
            opts.loading.finished = opts.loading.finished || function() {
                if (!opts.state.isBeyondMaxPage)
                    opts.loading.msg.fadeOut(opts.loading.speed);
            };

			// callback loading
            opts.callback = function(instance, data, url) {
                if (!!opts.behavior && instance['_callback_'+opts.behavior] !== undefined) {
                    instance['_callback_'+opts.behavior].call($(opts.contentSelector)[0], data, url);
                }

                if (callback) {
                    callback.call($(opts.contentSelector)[0], data, opts, url);
                }

				if (opts.prefill) {
					$window.bind("resize.infinite-scroll", instance._prefill);
				}
            };

			if (options.debug) {
				// Tell IE9 to use its built-in console
				if (Function.prototype.bind && (typeof console === 'object' || typeof console === 'function') && typeof console.log === "object") {
					["log","info","warn","error","assert","dir","clear","profile","profileEnd"]
						.forEach(function (method) {
							console[method] = this.call(console[method], console);
						}, Function.prototype.bind);
				}
			}

            this._setup();

			// Setups the prefill method for use
			if (opts.prefill) {
				this._prefill();
			}

            // Return true to indicate successful creation
            return true;
        },

		_prefill: function infscr_prefill() {
			var instance = this;
			var $window = $(window);

			function needsPrefill() {
				return (instance.options.contentSelector.height() <= $window.height());
			}

			this._prefill = function() {
				if (needsPrefill()) {
					instance.scroll();
				}

				$window.bind("resize.infinite-scroll", function() {
					if (needsPrefill()) {
						$window.unbind("resize.infinite-scroll");
						instance.scroll();
					}
				});
			};

			// Call self after setting up the new function
			this._prefill();
		},

        // Console log wrapper
        _debug: function infscr_debug() {
			if (true !== this.options.debug) {
				return;
			}

			if (typeof console !== 'undefined' && typeof console.log === 'function') {
				// Modern browsers
				// Single argument, which is a string
				if ((Array.prototype.slice.call(arguments)).length === 1 && typeof Array.prototype.slice.call(arguments)[0] === 'string') {
					console.log( (Array.prototype.slice.call(arguments)).toString() );
				} else {
					console.log( Array.prototype.slice.call(arguments) );
				}
			} else if (!Function.prototype.bind && typeof console !== 'undefined' && typeof console.log === 'object') {
				// IE8
				Function.prototype.call.call(console.log, console, Array.prototype.slice.call(arguments));
			}
        },

        // find the number to increment in the path.
        _determinepath: function infscr_determinepath(path) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_determinepath_'+opts.behavior] !== undefined) {
                return this['_determinepath_'+opts.behavior].call(this,path);
            }

            if (!!opts.pathParse) {

                this._debug('pathParse manual');
                return opts.pathParse(path, this.options.state.currPage+1);

            } else if (path.match(/^(.*?)\b2\b(.*?$)/)) {
                path = path.match(/^(.*?)\b2\b(.*?$)/).slice(1);

                // if there is any 2 in the url at all.    
            } else if (path.match(/^(.*?)2(.*?$)/)) {

                // page= is used in django:
                // http://www.infinite-scroll.com/changelog/comment-page-1/#comment-127
                if (path.match(/^(.*?page=)2(\/.*|$)/)) {
                    path = path.match(/^(.*?page=)2(\/.*|$)/).slice(1);
                    return path;
                }

                path = path.match(/^(.*?)2(.*?$)/).slice(1);

            } else {

                // page= is used in drupal too but second page is page=1 not page=2:
                // thx Jerod Fritz, vladikoff
                if (path.match(/^(.*?page=)1(\/.*|$)/)) {
                    path = path.match(/^(.*?page=)1(\/.*|$)/).slice(1);
                    return path;
                } else {
                    this._debug('Sorry, we couldn\'t parse your Next (Previous Posts) URL. Verify your the css selector points to the correct A tag. If you still get this error: yell, scream, and kindly ask for help at infinite-scroll.com.');
                    // Get rid of isInvalidPage to allow permalink to state
                    opts.state.isInvalidPage = true;  //prevent it from running on this page.
                }
            }
            this._debug('determinePath', path);
            return path;

        },

        // Custom error
        _error: function infscr_error(xhr) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_error_'+opts.behavior] !== undefined) {
                this['_error_'+opts.behavior].call(this,xhr);
                return;
            }

            if (xhr !== 'destroy' && xhr !== 'end') {
                xhr = 'unknown';
            }

            this._debug('Error', xhr);

            if (xhr === 'end' || opts.state.isBeyondMaxPage) {
                this._showdonemsg();
            }

            opts.state.isDone = true;
            opts.state.currPage = 1; // if you need to go back to this instance
            opts.state.isPaused = false;
            opts.state.isBeyondMaxPage = false;
            this._binding('unbind');

        },

        // Load Callback
        _loadcallback: function infscr_loadcallback(box, data, url) {
            var opts = this.options,
            callback = this.options.callback, // GLOBAL OBJECT FOR CALLBACK
            result = (opts.state.isDone) ? 'done' : (!opts.appendCallback) ? 'no-append' : 'append',
            frag;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_loadcallback_'+opts.behavior] !== undefined) {
                this['_loadcallback_'+opts.behavior].call(this,box,data);
                return;
            }

			switch (result) {
				case 'done':
					this._showdonemsg();
					return false;

				case 'no-append':
					if (opts.dataType === 'html') {
						data = '<div>' + data + '</div>';
						data = $(data).find(opts.itemSelector);
					}
					break;

				case 'append':
					var children = box.children();
					// if it didn't return anything
					if (children.length === 0) {
						return this._error('end');
					}

					// use a documentFragment because it works when content is going into a table or UL
					frag = document.createDocumentFragment();
					while (box[0].firstChild) {
						frag.appendChild(box[0].firstChild);
					}

					this._debug('contentSelector', $(opts.contentSelector)[0]);
					$(opts.contentSelector)[0].appendChild(frag);
					// previously, we would pass in the new DOM element as context for the callback
					// however we're now using a documentfragment, which doesn't have parents or children,
					// so the context is the contentContainer guy, and we pass in an array
					// of the elements collected as the first argument.

					data = children.get();
					break;
			}

            // loadingEnd function
            opts.loading.finished.call($(opts.contentSelector)[0],opts);

            // smooth scroll to ease in the new content
            if (opts.animate) {
                var scrollTo = $(window).scrollTop() + $(opts.loading.msg).height() + opts.extraScrollPx + 'px';
                $('html,body').animate({ scrollTop: scrollTo }, 800, function () { opts.state.isDuringAjax = false; });
            }

            if (!opts.animate) {
				// once the call is done, we can allow it again.
				opts.state.isDuringAjax = false;
			}

            callback(this, data, url);

			if (opts.prefill) {
				this._prefill();
			}
		},

        _nearbottom: function infscr_nearbottom() {

            var opts = this.options,
            pixelsFromWindowBottomToBottom = 0 + $(document).height() - (opts.binder.scrollTop()) - $(window).height();

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_nearbottom_'+opts.behavior] !== undefined) {
                return this['_nearbottom_'+opts.behavior].call(this);
            }

            this._debug('math:', pixelsFromWindowBottomToBottom, opts.pixelsFromNavToBottom);

            // if distance remaining in the scroll (including buffer) is less than the orignal nav to bottom....
            return (pixelsFromWindowBottomToBottom - opts.bufferPx < opts.pixelsFromNavToBottom);

        },

        // Pause / temporarily disable plugin from firing
        _pausing: function infscr_pausing(pause) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_pausing_'+opts.behavior] !== undefined) {
                this['_pausing_'+opts.behavior].call(this,pause);
                return;
            }

            // If pause is not 'pause' or 'resume', toggle it's value
            if (pause !== 'pause' && pause !== 'resume' && pause !== null) {
                this._debug('Invalid argument. Toggling pause value instead');
            }

            pause = (pause && (pause === 'pause' || pause === 'resume')) ? pause : 'toggle';

            switch (pause) {
                case 'pause':
                    opts.state.isPaused = true;
                break;

                case 'resume':
                    opts.state.isPaused = false;
                break;

                case 'toggle':
                    opts.state.isPaused = !opts.state.isPaused;
                break;
            }

            this._debug('Paused', opts.state.isPaused);
            return false;

        },

        // Behavior is determined
        // If the behavior option is undefined, it will set to default and bind to scroll
        _setup: function infscr_setup() {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_setup_'+opts.behavior] !== undefined) {
                this['_setup_'+opts.behavior].call(this);
                return;
            }

            this._binding('bind');

            return false;

        },

        // Show done message
        _showdonemsg: function infscr_showdonemsg() {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_showdonemsg_'+opts.behavior] !== undefined) {
                this['_showdonemsg_'+opts.behavior].call(this);
                return;
            }

            opts.loading.msg
            .find('img')
            .hide()
            .parent()
            .find('div').html(opts.loading.finishedMsg).animate({ opacity: 1 }, 2000, function () {
                $(this).parent().fadeOut(opts.loading.speed);
            });

            // user provided callback when done    
            opts.errorCallback.call($(opts.contentSelector)[0],'done');
        },

        // grab each selector option and see if any fail
        _validate: function infscr_validate(opts) {
            for (var key in opts) {
                if (key.indexOf && key.indexOf('Selector') > -1 && $(opts[key]).length === 0) {
                    this._debug('Your ' + key + ' found no elements.');
                    return false;
                }
            }

            return true;
        },

        /*	
            ----------------------------
            Public methods
            ----------------------------
            */

        // Bind to scroll
        bind: function infscr_bind() {
            this._binding('bind');
        },

        // Destroy current instance of plugin
        destroy: function infscr_destroy() {
            this.options.state.isDestroyed = true;
			this.options.loading.finished();
            return this._error('destroy');
        },

        // Set pause value to false
        pause: function infscr_pause() {
            this._pausing('pause');
        },

        // Set pause value to false
        resume: function infscr_resume() {
            this._pausing('resume');
        },

		beginAjax: function infscr_ajax(opts) {
			var instance = this,
				path = opts.path,
				box, desturl, method, condition;

			// increment the URL bit. e.g. /page/3/
			opts.state.currPage++;

            // Manually control maximum page 
            if ( opts.maxPage != undefined && opts.state.currPage > opts.maxPage ){
                opts.state.isBeyondMaxPage = true;
                this.destroy();
                return;
            }

			// if we're dealing with a table we can't use DIVs
			box = $(opts.contentSelector).is('table, tbody') ? $('<tbody/>') : $('<div/>');

			desturl = (typeof path === 'function') ? path(opts.state.currPage) : path.join(opts.state.currPage);
			instance._debug('heading into ajax', desturl);

			method = (opts.dataType === 'html' || opts.dataType === 'json' ) ? opts.dataType : 'html+callback';
			if (opts.appendCallback && opts.dataType === 'html') {
				method += '+callback';
			}

			switch (method) {
				case 'html+callback':
					instance._debug('Using HTML via .load() method');
					box.load(desturl + ' ' + opts.itemSelector, undefined, function infscr_ajax_callback(responseText) {
						instance._loadcallback(box, responseText, desturl);
					});

					break;

				case 'html':
					instance._debug('Using ' + (method.toUpperCase()) + ' via $.ajax() method');
					$.ajax({
						// params
						url: desturl,
						dataType: opts.dataType,
						complete: function infscr_ajax_callback(jqXHR, textStatus) {
							condition = (typeof (jqXHR.isResolved) !== 'undefined') ? (jqXHR.isResolved()) : (textStatus === "success" || textStatus === "notmodified");
							if (condition) {
								instance._loadcallback(box, jqXHR.responseText, desturl);
							} else {
								instance._error('end');
							}
						}
					});

					break;
				case 'json':
					instance._debug('Using ' + (method.toUpperCase()) + ' via $.ajax() method');
					$.ajax({
						dataType: 'json',
						type: 'GET',
						url: desturl,
						success: function (data, textStatus, jqXHR) {
							condition = (typeof (jqXHR.isResolved) !== 'undefined') ? (jqXHR.isResolved()) : (textStatus === "success" || textStatus === "notmodified");
							if (opts.appendCallback) {
								// if appendCallback is true, you must defined template in options.
								// note that data passed into _loadcallback is already an html (after processed in opts.template(data)).
								if (opts.template !== undefined) {
									var theData = opts.template(data);
									box.append(theData);
									if (condition) {
										instance._loadcallback(box, theData);
									} else {
										instance._error('end');
									}
								} else {
									instance._debug("template must be defined.");
									instance._error('end');
								}
							} else {
								// if appendCallback is false, we will pass in the JSON object. you should handle it yourself in your callback.
								if (condition) {
									instance._loadcallback(box, data, desturl);
								} else {
									instance._error('end');
								}
							}
						},
						error: function() {
							instance._debug("JSON ajax request failed.");
							instance._error('end');
						}
					});

					break;
			}
		},

        // Retrieve next set of content items
        retrieve: function infscr_retrieve(pageNum) {
			pageNum = pageNum || null;

			var instance = this,
            opts = instance.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['retrieve_'+opts.behavior] !== undefined) {
                this['retrieve_'+opts.behavior].call(this,pageNum);
                return;
            }

            // for manual triggers, if destroyed, get out of here
            if (opts.state.isDestroyed) {
                this._debug('Instance is destroyed');
                return false;
            }

            // we dont want to fire the ajax multiple times
            opts.state.isDuringAjax = true;

            opts.loading.start.call($(opts.contentSelector)[0],opts);
        },

        // Check to see next page is needed
        scroll: function infscr_scroll() {

            var opts = this.options,
            state = opts.state;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['scroll_'+opts.behavior] !== undefined) {
                this['scroll_'+opts.behavior].call(this);
                return;
            }

            if (state.isDuringAjax || state.isInvalidPage || state.isDone || state.isDestroyed || state.isPaused) {
				return;
			}

            if (!this._nearbottom()) {
				return;
			}

            this.retrieve();

        },

        // Toggle pause value
        toggle: function infscr_toggle() {
            this._pausing();
        },

        // Unbind from scroll
        unbind: function infscr_unbind() {
            this._binding('unbind');
        },

        // update options
        update: function infscr_options(key) {
            if ($.isPlainObject(key)) {
                this.options = $.extend(true,this.options,key);
            }
        }
    };


    /*	
        ----------------------------
        Infinite Scroll function
        ----------------------------

        Borrowed logic from the following...

        jQuery UI
        - https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js

        jCarousel
        - https://github.com/jsor/jcarousel/blob/master/lib/jquery.jcarousel.js

        Masonry
        - https://github.com/desandro/masonry/blob/master/jquery.masonry.js		

*/

    $.fn.infinitescroll = function infscr_init(options, callback) {


        var thisCall = typeof options;

        switch (thisCall) {

            // method 
            case 'string':
                var args = Array.prototype.slice.call(arguments, 1);

				this.each(function () {
					var instance = $.data(this, 'infinitescroll');

					if (!instance) {
						// not setup yet
						// return $.error('Method ' + options + ' cannot be called until Infinite Scroll is setup');
						return false;
					}

					if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
						// return $.error('No such method ' + options + ' for Infinite Scroll');
						return false;
					}

					// no errors!
					instance[options].apply(instance, args);
				});

            break;

            // creation 
            case 'object':

                this.each(function () {

                var instance = $.data(this, 'infinitescroll');

                if (instance) {

                    // update options of current instance
                    instance.update(options);

                } else {

                    // initialize new instance
                    instance = new $.infinitescroll(options, callback, this);

                    // don't attach if instantiation failed
                    if (!instance.failed) {
                        $.data(this, 'infinitescroll', instance);
                    }

                }

            });

            break;

        }

        return this;
    };



    /* 
     * smartscroll: debounced scroll event for jQuery *
     * https://github.com/lukeshumard/smartscroll
     * Based on smartresize by @louis_remi: https://github.com/lrbabe/jquery.smartresize.js *
     * Copyright 2011 Louis-Remi & Luke Shumard * Licensed under the MIT license. *
     */

    var event = $.event,
    scrollTimeout;

    event.special.smartscroll = {
        setup: function () {
            $(this).bind("scroll", event.special.smartscroll.handler);
        },
        teardown: function () {
            $(this).unbind("scroll", event.special.smartscroll.handler);
        },
        handler: function (event, execAsap) {
            // Save the context
            var context = this,
            args = arguments;

            // set correct event type
            event.type = "smartscroll";

            if (scrollTimeout) { clearTimeout(scrollTimeout); }
            scrollTimeout = setTimeout(function () {
                $(context).trigger('smartscroll', args);
            }, execAsap === "execAsap" ? 0 : 100);
        }
    };

    $.fn.smartscroll = function (fn) {
        return fn ? this.bind("smartscroll", fn) : this.trigger("smartscroll", ["execAsap"]);
    };


})(window, jQuery);

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJqcXVlcnkuaW5maW5pdGVzY3JvbGwuanMiXSwic291cmNlc0NvbnRlbnQiOlsiLypqc2hpbnQgdW5kZWY6IHRydWUgKi9cbi8qZ2xvYmFsIGpRdWVyeTogdHJ1ZSAqL1xuXG4vKlxuICAgLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgIEluZmluaXRlIFNjcm9sbFxuICAgLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgICsgaHR0cHM6Ly9naXRodWIuY29tL3BhdWxpcmlzaC9pbmZpbml0ZS1zY3JvbGxcbiAgICsgdmVyc2lvbiAyLjBiMi4xMjA1MTlcbiAgICsgQ29weXJpZ2h0IDIwMTEvMTIgUGF1bCBJcmlzaCAmIEx1a2UgU2h1bWFyZFxuICAgKyBMaWNlbnNlZCB1bmRlciB0aGUgTUlUIGxpY2Vuc2VcblxuICAgKyBEb2N1bWVudGF0aW9uOiBodHRwOi8vaW5maW5pdGUtc2Nyb2xsLmNvbS9cbiovXG5cbihmdW5jdGlvbiAod2luZG93LCAkLCB1bmRlZmluZWQpIHtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cbiAgICAkLmluZmluaXRlc2Nyb2xsID0gZnVuY3Rpb24gaW5mc2NyKG9wdGlvbnMsIGNhbGxiYWNrLCBlbGVtZW50KSB7XG4gICAgICAgIHRoaXMuZWxlbWVudCA9ICQoZWxlbWVudCk7XG5cbiAgICAgICAgLy8gRmxhZyB0aGUgb2JqZWN0IGluIHRoZSBldmVudCBvZiBhIGZhaWxlZCBjcmVhdGlvblxuICAgICAgICBpZiAoIXRoaXMuX2NyZWF0ZShvcHRpb25zLCBjYWxsYmFjaykpIHtcbiAgICAgICAgICAgIHRoaXMuZmFpbGVkID0gdHJ1ZTtcbiAgICAgICAgfVxuICAgIH07XG5cbiAgICAkLmluZmluaXRlc2Nyb2xsLmRlZmF1bHRzID0ge1xuICAgICAgICBsb2FkaW5nOiB7XG4gICAgICAgICAgICBmaW5pc2hlZDogdW5kZWZpbmVkLFxuICAgICAgICAgICAgZmluaXNoZWRNc2c6IFwiPGVtPkNvbmdyYXR1bGF0aW9ucywgeW91J3ZlIHJlYWNoZWQgdGhlIGVuZCBvZiB0aGUgaW50ZXJuZXQuPC9lbT5cIixcblx0XHRcdGltZzogXCJkYXRhOmltYWdlL2dpZjtiYXNlNjQsUjBsR09EbGgzQUFUQVBRZUFQRHkrTW5RNkxXLzROM2g4TXpUNnJqQzRzVE01ci9JNU5IWDdON2o4YzdVNnR2ZzhPTGw4dVhvOU9qcjliM0c1TWZQNk92dTl0UFo3UFQxK3ZYMit0YmI3dmY0KzgvVzY5amQ3ckM3M3ZuNS9PL3grSzI0M2FpMDIvLy8vd0FBQUNIL0MwNUZWRk5EUVZCRk1pNHdBd0VBQUFBaCtRUUVDZ0QvQUN3QUFBQUEzQUFUQUFBRi82QW5qbVJwbm1pcXJtenJ2bkFzejNSdDMzaXU3M3p2LzhDZ2NFajBCQVNjcEhMSmJEcWYwS2gwU3ExYXI5aXNkaW9JdEFLR3crTUFLWU1GaGJGNjNDVzQzOGYwbWcxUjJPOEV1WGovYU9QdGFIeDdmbjk2Z29SNGhtdUlkNHFEZFg5NWM0K1JCSUdDQjR5QWpwbVFoWk4wWUdZR1hpdGRaQklWR0FzTG9xNEJCS1FEc3dtMUNRUmtjRzZ5dHJZS3VicTh2YmZBY01LOXY3cTdFTU8xeWNySHZzVzZ6Y1RLc2N6Tno4SFp3OXZHM2NqVHNNSVlxUWtDTEJ3SENnc01EUTRSREFZSXFmWVNGeER4RWZ6ODgvWDM4T25yMTYrQnA0QURDY283ZUM4aFFZTUFFZTU3eU5DZXc0SVZCVTdFR05EaVJuOFo4MzFjR0xIaFNJZ2RGZjljaEllQmc3b0E3Z2phV1VXVFZRQUdFM0xxQkRDVGxjOVdPSGZtN1BrVHFOQ2g1NHJlUERxQjZNK2xSNTM2aENwVXFzMmdWWk0reGJyVHF0R29XcWR5MWVtVmFsZVhLemdnWUJCQjV5MWFjRk5abUV2WEFvTjJjR2ZKclR2M2JsNjlGZmoyeFp0M0wxKy9mdzNYUlZ3NHNHREdjUjBmSmh4WnNGM0t0QlRUaFp4WjhtTE1nQzNmUmF0Q2JZTU5GQ3p3TEVxTGdFNE5zRFdzL3R2cWRlelpmMTNIdmsyQTlTemR1MlgzcGcxOE4rNjh4WG43cmgxYytQTGtzSS9EaGU2Y3VPM293M05mVjkyYmRBclRxQzJFYmQzQTh2amY1UVdmSDZCZzdOejE3YzJmajY5K2ZucSs4TjJMdHkrZnVQNzgvZVYyWDEzbmVJY0NlQlJ3eG9yYlpyQTFBTm9DREdyZ29HOFJUc2hhaFE5aVNLRUV6VW1ZSVlmTldWaVVoaGVDR0p5SVA1RTRvb203V1dqZ0NlQkZBSk52MURWVjAxTUFkSmhoamRrcGxXTnpPLzVvWEk4NDZuampWRUlxUjJPUzJCMXBFNVBWc2Nhamt4aE15Y3FMSmdoUVN3VDQwUGdmQWw0R3FOU1hZZFpYSm41Z1NrbW1tbUp1MWFaWWIxNFY1MWRvK3BUT0NtQTQwQXFWQ0loRzVJSjlQdlluaElGT3htZHFocGFJNkdlSEN0cG9vaXN1dXRtZytFZzYyS09NS3Vxb1RhWGdpY1FXb0lZcTZxaWtsbW9xRlYwVW9lcXFyTGJxNnF1d3hpcnJyTFRXYXV1dEo0UUFBQ0g1QkFVS0FCd0FMQWNBQkFET0FBc0FBQVgvSVBkMEQyZHlSQ29VcC9rOGdwSE9LdHNlUjl5aVNtR2J1QnlrbGVyOVhMQWhrYkRhdlhUTDVrMm9xRnFOT3h6VVpQVTVZWVpkMVhzRDcyclpwQmpiZWg1Mm1TTm5NU0M4bHdibEtaR3dpKzBRZklKOENuY25Db0NEZ29WbkJIbUtmQnlHSmltUGtJd3RpQWVCa0g2WkhKYUttQ2VWbktLVEhJaWhnNUtOcTR1b3FtRXRjUlV0RVJFTUJnZ3RFcjRRRHJqQ3VSQzhoNy9Cd3hFTmVpY1NGOERLeTgycHlOTE1PeHpXeWd6Rm1kdkQyTDNQMGR6ZTQrWGgxQXJreWVwaTdkZkZ2dlR0TFFrWkJDMFQvRlgzQ1JnQ01PQkhzSitFSFlRWTdPaW5BR0VDZ1FzQitMdTNBT0srQ2V3Y1dqd3hRZUpCaWh0TkdIU29RT0UraVEzLy80WGt3QkJoUlpNY1VTNllTWE9Bd0lMOFBHcUVhU0pDaVl0OVNOb0NtbkpQQWdVVkxDaGRhb0ZCVVJOOE1BemwyUFFwaHdRTGZERmQ2bFRvd2dsSHZlNnJLcGJqaEs3L3BHNVZpblpQMXFraXoxcmw0K3RyMkxSd1dVNjRjRkVpaHdFdFpnYmdSMVVpSGFNVnZ4cE9Td0JBMzdrekd6OWU4RytCNU1JRUtMdXRPR0VzQUgyQVRRd1lmVG11WDhhRVRXZEdQWm1pWmNjY05TemVUQ0ExU3cwYmRpaXRDN0xCV2d1OGpRcjhIUnpxZ3BLNmdYODhRYnJCMTR6L2tGK0VMcHdCOGVWUWovSmtxZHlsQXVkamkvK3RzMzAzOXZFRWZLOFZ6MmRsdnhaS0cwQ21ia0tEQnZsbFJkNmZDekR2QkxLQkRTQ2VmZmhSSkVGZWJGazFrL012OWpWSW9JSlpTZUJnZ3dVYU5lQitRazM0SUUwY1hsaWhjZlJ4a09BSkZGaHdHbUtsbVdEaWFrWmhVSnRuTEJwbldXY25LYUFaY3hJMHBpRkdHTEJtMW1jOTBrYWpTQ3ZlZUJWV0tlWUVvVTJ3cWVhUWkwUGV0b0UrcnIxNEVwVkM3b0FiQVVIcWhZRXhibjJYSEhzVnFiY1Zldzl0eDgrWEpLazVBWnNxcWRsZGRHcHFBS2RiQVlCbjFwY2N6bVNUZFd2ZG1aMTdjMWIzRlo5OXZuVGRDUkZNOE9FY0FoTHdtMU5kWG5XY0JCU01SV21ma1dacVZsc21MSWlBcC9vMWdHVjJ2cFM0bGFsR1lzVU9xWHJkZGNLQ21LNjFhWjhTakVwVXBWRlZvQ3BUajRyNjYxS203a0JIanJEeWMxUkFJUUFBSWZrRUJRb0FHd0FzQndBRUFNNEFDd0FBQmYvZ3RtVUNkNGdvUVFnRktqNlBZS2kweXJyYmM4aTRvaFF0MTJFSGNhbCtNTlNRaUNQOGdpZ2R6N2lDaW9hQ0l2VW1aTHA4UUJ6VzBFTjJ2U2xDdUR0RkthcTRSeUh6UUxFS1pOZGlRRGhSRFZvb0N3a2JmbTU5RUFtS2k0U0dJbStBaklzS2poc3FCNG1TalQySU9JT1VuSUNlQ2FCL21aS0ZOVFNSbXFWcG1KcWtsU3Fza3E2UGZZWUNEd1lIREM0UkVRd0dDQkxHeHhJUURzSE13aEFJWDhiS3pjRU5nU0xHRjlQVTFqM1N5OXpYMk5yZ3pRemlDaExrMUJIV3hjamY3TjA0NnR2TjgyNzE1Y3puOVByeXo2SWxjNEFDajRFQk9DWk04S0VuQVlZQURCUktuQUNBWVVNRnYxd290SWhDRWNhSkNpc3F3SkZnQVVTUUd5WC9rQ1NWVVVUSWRLTXdKbHlvMG9YSGxoc2t3clRKY2laSEVYc2dhcVM0czZQSmlDQXIxdXpZVThrQkJTZ25XRnFwb01KTVVqR3REbVV3a21mVm1WeXBha1doRUt2WHNTNG5oTFc1d05qVnJvSklvYzA1d1N6VHIwUHRpaWdwWWU0RUMydmo0aVdyRnU1ZXVXSU1SQmhhY2FWSmhZUUJFRmpBOWpIanlRMHhFQUJ3R2NlR0FaWWpZMFlCT3JSTEN4VXAyOVFNK2JSa3g1czdaeVlnVmJUcXd3dGkyeWJKK3ZMdERZcHljeVpiWU9scHR4ZHgwa1YrVjdsQzVpSkF5eVJyd1lLeEFkaXo4Mm5nMC9qbkFkTUpGejBjUGkxMDRFYzFWajkvTTZGMTczdktML2ZlWHYxNTZkdzExdGxxZU1NbnY0VjVBcDUzR21qUVFIOTduRmZnK0lGaXVjZmdSWDVaOEtBZ2JVbFE0SVVMSWxnaGhoZE9TQjZBZ1gwSVZuOGVSZWdoZW4zTlJJQnNSZ25INGw0THVFaWRaQmp3UnB0Nk5NNVdHd29XMEtTakN3WDZ5SlNNYWIyR3d3QVBEWGZhQkN0V3BsdVJUUXFDNUpNNW9VWkFqVU5TK1ZlT0xXcEpFUTdWWVFBTlcwSU5KU1pWREZTblpwaGpTaWtmbXpFNU40RUViUUkxUUptbldYQ21IdWxScDJlZHdEWEY0M3R4dWtlbkp3dkk5eHlnOVEyNlozTXpHVWNCWUZFQ2haaDZEVlRxMzRBVThJZmxoNTFTZCtDbktGWVE2bW1aa2hxZkJLZlN4WldxQTlEWmFuV2p4bWhyV3dpMHF0Q3J0LzQzSzZXcVZqanBtaElxZ0VHdmN1bGFHS2tsS3N0QUFDRUFBQ0g1QkFVS0FCd0FMQWNBQkFET0FBc0FBQVgvSUNkeVFtYU1ZeUFVcVBnSUJpSFB4TnB5NzlrcVJYSDh3QVBzUm1EZFhwQVdnV2RFSVltMmxsQ0hxalZIVStqakprd3FCVGVjd0l0U2hNWGtFZk5XU2g4ZTFOR0FjTGdwREdsUmdrN0VKLzZBZTNWS2ZvRi9mRHVGaG9oVmVEZUNmWGtjQ1FxRFZRY1FobitWTkRPWW1wU1dhb3FCbFVTZm1vd2pFQStpRUFFR0RSR3p0QXdHQ0RjWEVBNjB0WEVpQ3JxOHZSRU1FQkxJeVJMQ3hNV1NITXpFeG5iUnZRMlN5N3ZOMHp2VnROZlUydExZM3JQZ0xkbkR2Y2E0VlFTL0NwazNBQndTTFFrWUFRd1QvUDMwOXZjSTdPdlhyOTRqQlFNSi9uc2trR0EvQlFCUkxORG5jQUlBaURjRzZMc3hBV09MaVF6bWVVUkJLV1NMQ1Fidi8xRjBlREdpbkpVS1I0N1lZMUlFZ1FBU0trN1ljN0FDUndabTdtSHdlUkpvejU5QkpVb2dpc0tDVWFGTVIweDRTbEpCVkJGVGs4cFppdlRSMEs3M3JONXdxbFhFQXE1RnkzSVlnSGJFelEwbkx5NFFTb0NqWExvb205NlZPSkVlQ29zSzVuNGtrRmZxWGpsOTR3YStsMWd2QWNHSUNiZXdBT0F4WThsL0t5L1FoQUd6NGNVa0d4dTJITm96aHdNR0JuQ1VxVWRCZzlVdVc5ZVV5bnFTd0xISUJ1amVQZWYxWkdRWlhjTStPRnVFQmVCaGkzT1lnTHlxY3VheGJUOXZMa2Y0U2VxeVd4U1FwS0dCMmdRcG0xS2RXYnU3MnJQUnpSOU5lMk51OUt6ci8xSnFqMHlEL2Z2cVA0YVhPdDVzVy81cXNYWFZjdjFOc3A4SUJVQW1nc3dHRjNsbEdnZVUxWVZYWEtUTjFGbGhXRlhXM2dJRStEVkNoQXB5c0FDSEhvN1E0QTM1bExpY2hoK1JPQm1MS0F6Z1ltWUVZREFoQ2d4S0dPT01uNFdSNGtrRGFvQkJPeEp0ZE5LUXhGbWc1SklXSUJuUWMwN0dhT1JmVVk0QUVrZFY2akhsQ0VJU1NaNXlUWHBwMXBiR1pia1dtY3VabVFDYUU2aUowRmhqTWFEalRNc2daYU5FSEZSQVFWcDNicVhuWkVEMXFZY0VDT3o1VjZCaFNXQ29WSlFJS3VLUWkyS0ZLRWtFRkFxb0FvN3VZU21PM2prNjF3VVVNS21rbko0U0dpbUJtQWEwcVZRQmhBQUFJZmtFQlFvQUd3QXNCd0FFQU00QUN3QUFCZi9nSm01Rm1SbEVxaEpDK2J5d2dLNXBPNHJISTBEM3BpaTIyK01nNi8wRWo5NndlQ01BazdjRGtYZjdsWlRUbnJNbDdlYVlveTEwSk4wWkZkY28wWEF1dktJNnFrZ1ZGSlhZTndqa0lCY05CZ1I4VFFvR2ZSc0pDUnVDWVlRUWlJK0lDb3NpQ29HT2tJaUtmU2w4bUprSFo0VTlrWk1iS2FJM3BLR1htSktybmdtdWc0V3draEEwbHJDQldnWUZDQ01RRndvUURSSEd4d3dHQ0JMTXpSTEV4OGlHek1NTzBjWU5lQ01LekJEVzE5bG5GOURYRElZLzQ4WGcwOTNmMFEzczFkY1I4T0xlOCtZOTFPVHY1d3JqN283Qis3Vk5RcUFCSW9SVkNNQmdnc09IRTM2a1NvQ0JJY1NIM0ViRmFuZ3hvZ0pZRmk4Q2tKaHFRY2lMSkVmL0xEREpFZUpJQlQwR3NPd1lVWUpHQlMwZmpwUUFNaWRHbXlWUDZzeDRZNlZRaHpzOVZVd2t3cWFDQ2gwdG1Lb0Z0U01EbUJPZjlwaGc0U3JWclJPdWFzUlFBYXhYcFZVaGRzVTZJc0VDWmx2WDNrd0xVV3pSdDBCSE9MVGJObGJaRzN2WmluQXJnZTVEdm43d2JxdFFrU1lBQWd0S21uU3NZS1ZLbzJBZlcwNDh1YVBtRzM4Nmk0UThFUU1CQUlBbmZCN3hCeEJxdmFwSjl6WDlXZ1JTMllNcG52WU1HZFBLM2FNanQvM2RVY05JNGJscGo3aXdrTUZXRFhEdlNtZ0FsaWpydDlSVFI3OCtQUzZ6MXVBSlpJZTkzUThnNXpjc1dDaS80WStDOGJhaDV6VXYzdnY4OXVmdDMwUVAyM3B1bkdDeDU5NTRvQkJ3bndZYU5DRFkvd1lyc1llZ2duTTlCMkZwZjhHRzJDRVVWV2hiV0F0R291RUdEeTdZNElFSlZyYlNpWGdocUdLSW83ejFJVmNYSWtLV1dSMzYxUU9MV1duSWh3RVJwTGFhQ0NlZTVpTUJHSlFtSkd5UEZUbmJrZkhWWkdSdElHcmc1SEFMRUpBWmJ1MzlCdVVFVW1xMUpKUUlQdFppbFk1aEdlU1dzU2s1Mkc5WHFzbWdsamRJY0FCeXRxMTNIeUlNNlJjVUErcjFxWjRFQkYzV0hXQjI5dEJnQXpSaEVHaGlnOEttcUtGdjhTZUNlbyttZ3NGN1lGWGExcVdTYmtEcG9tL21xUjFQbUhDcUozZndOUlZYakM3UzZDWmhGVkNRMmxXdlppaXJoUXE0MlNBQ3QyNUlLMmh2OFRwcnJpVVYxdXNHZ2VrYTdMRmNObUNsZE1MaTZxWk1nRkxncHcxNkNpcGI3YkMxa25Yc0JpRUFBQ0g1QkFVS0FCc0FMQWNBQkFET0FBc0FBQVgvNEZac0pQa1VtVUdzTENFVVR5d1hnbEZ1U2c3ZlcxeEF2TldMRjZzRkZjUGI0MkM4RVpDajI0RUpkQ3AyeW9lZ1dzb2xTMFV1NmZtYW1nOG44WVljTFUyYlhTaVJhWE1HdnFWNi9LQWVKQWg4VmdacUNYK0JleENGaW9XQVlncU5pNHFBUjRPUmhSdUhZNDA4akFlVWhBbVlZaXVWbHBpZmxxR1phNUNXa3pjNWZLbWJiaElwc0FvUURSRzh2UXdRQ0JMQ3d4SzZ2YjVxd2hmR3h4RU5haHZDRUE3Tnpza1N5N3ZOenp6SzA5Vy9QTkhGMU52WDJkWGNOOEs1NWNmaDY5THV2ZW9sM3ZPOHp3aTRZaGorQVF3bUNCdzRJWWNsREFBSkRsUWdnVk9DaEFvTEtrZ0ZrU0NBSER3V0xLaElFT09OQVJzREtyeW9nRlBJaUFVYi85NWdKTklpdzR3bkk3NzhHRlBoekJLRk9BcThxTEpFaFFwaU5BcmpNY0hDbWxUQ1VESW91VEtCaEFwRUxTeEZXaUdpVktZNEUyQ0Fla1BnVXBoRHUwNzQyblJyVkxKWm55ckZTcUtRMm9ob1NZQU1XNklvRHBOSjRiTGRJTFRuQWo4S1VGN1VlRU5qQUt1RHl4SWdPdUdpT0kwRUJCTWdMTmV3NUFVckRUTUdzRml4d0JJYU5DUXVBWEpCNTdxTkoyT1dtMkFqNHNrd0NRQ0l5TmtoaHRNa2RzSXVvZEUwQU40TEpEUmdmTFB0bjVZRExkQmxyYUFCeXVVYkJneFF3SUN4TU9uWXBWT1BlajA3NE9GZGxmYzBUcUM2Mk9JYmNwcEhqVjRvK0xyaWVXaGZUOEpDL0kvVDZXOG9DbDI5dlEwWGpMZEJhQTNzMVJjUEJPN2xGdnBYOEJWb0c0TzVqVFhSUVJEdUo2RkRUekVXRjEvQkNaaGdieUFLRTlxSUNZTGxvUVlPRnRhaFZSc1dZbFo0S1FKSGx3SFMvSVlhWjZzWmQ5dG11NUhRbTJ4aTFVYVRienhZd0prL3dCRjVnNUVFWU9CWmVFZkdabU5kRnlGWm1aSVI0amlrYkxUaGxoNWtVVVZKR21SVDdzZWtremlSV1VJQUNBQmszVDRxQ3NlZGdPNHhoZ0djWTdxNXBISjRrbEJCVFFSSjBDZUhjb1lISFVoNndnZmRuOXVKZFNkTWllYkdKMHpVUFRjb1MyODZGQ2tyWnhuWW9ZWUtXTGtCb3doUW9CZWFPbFpBZ1ZoTGlkclhxZzJHaXFwUXBaNGFwd1N3UnRqcXJCM211b0Y5QmJvYVhLbXNobHFXcXNXaUd0MndwaEprUWJBVTVob0NBQ0g1QkFVS0FCc0FMQWNBQkFET0FBc0FBQVgvb0dGdzJXWnVUNW9aUk9zU1FuR2FLalJ2aWxJODkzTUl0bE5PSjV2NWdEY0ZySGhLSVdjRVl1L3hGRXFOdjZCMU42MmFjbHlzRjdmc1pZZTVhT3gyeUw1YUFVR1NhVDFvVFlNQndRNVZHQ0FKZ1lJSkNueDFnSU9CaFhkd2lJbDdkMHAyaVlHUVVBUUJqb09GU1FSL2xJUUhuWitVZTZPYWdxWXpTcVNKaTVlVHBUeEdjamNTQ2hBTkVidThEQkFJRXNIQkNoZTV2TDEzRzdmRnVzY1JEY25LdU0zSDBMYTNFQTdPejhrS0VzWGF6cjdDdzkvR3p0YXI1dUhIdnRlNDdNamt0em5aMncwRzErRDNCZ2lyQXFKbUpNQVFnTUdFZ3dnbjVFaTBnS0RCaEJNQUxHUllFT0pCYjVRY1dsUW80Y2JBaWhaejNHZ0lNcUZFQlNNMS80WkVPV1BBZ3BJSUpYWVUrUEloUkc4amExcVU2VkhselprbkpOUTZVYW5DalFrV0NJR1NVR0VqQXdWTGpjNDQrRFRxVVF0UFBTNWdlalVyVGE1VEozZzlzV0NyMUJOVVdaSTE2MVN0aVFVRG1MWWRHZmVzaWJRM1hNcTFPUFl0aHJ3dUEyeVUyTEJzMmNCSEl5cFlRUFBsWUFLRkQ1Y1Z2TlB0VzhlVkdiZGNRQURBVHNpTk80Y0ZBUGt2SHBlZFB6YzhrVWNQZ05HZ1o1Uk5EWkcwNXJlb0U5czJ2U0VQNzlNRUdpUUd5MXFQOExBNFpjZHRzSkU0OE9Ob0xUQnRUVjBCOUxzVG5QY2VvSURCRFF2UzdXN3ZmalZZM3EzZVo0QTMzOUo0ZWFBbUtxVS9zVjU4SHZKaDJSY25JQnNEVXcwQUJxaEJBNWFWNVY5WFVGR2lIZlZlQWlXd29GZ0pKcklYUkgxdEVNaURGVjRvSG9BRUdsYVdoZ0lHU0dCTzJuRm9tWVkzbUtqVmdsaWRhTllKR0pEa1dXMnh4VGZiakNiVmFPR05xb1gyR2xvUjhaZVRhRUNTOXB0aFJHSkgyZzBiM0FnYms2aE5BTnR0ZUhEMkdKVXVjZmFqQ1FCeTVPT1RRMjVaZ1VQdmFWVlFtYktoOTUxMC9xUXB3WHgzU1FkZms4dFpKT2Q1YjZKSkZwbFQzWm5tbVgzcWQ1bDFlZzVxMDBIcnRVa1VuMEFLYWlHakNsU0FnS0xZWmNnV1h3b2NHUmNDRkdDS3dTQjZjZXFwaHdtWVJVRllULzFXS2xPZFVwaXBteFcwbWxDcUhqWWtBYWVvWmxxcnFaNHFkK3VwUUthYXBuL0FtZ0FlZ1o4S1V0WXRGQVFRQWdBaCtRUUZDZ0FiQUN3SEFBUUF6Z0FMQUFBRi8rQzJQVWNtaUNpWkdVVHJFa0tCaXM4alFFcXVLd1U1SHlYSWJFUGd5WDdCWWE1d1RObUVNd1dzU1hzcUZiRWg4RFlzOW1yZ0dqZEs2R2tQWTVHT2VVNnJ5ejdVRm9wU1FFenlnT0doSkJqb0lnTURCQWNCTTBWL0NZcUxDUXFGT3dvYmlZeUtqbjJUbEk2R0tDMllqSlprbm91YVpBY1FsSlVIbDZlb29Kd0tvb29icW9ld3JKU0VteUtkdDU5TmhSS0ZNeExFRUE0UnlNa01FQWpERWhmR3ljcUFHOFRReDlJUkRSREUzZDNSMmN0RDFSTGcwdHRLRW5iWTV3WkQzK3pKNk03WDJSSGk5T2J5N3UvcjlnMzhVRmpUaDJ4WkpCRUJNREFib29nQWd3a1FJMDdJTVVPUndvY1NKd0NnV0RGQkFJd1pPYUpJc09CalJvZ0tKUDh3VE9EdzVFU1ZIVnRtM0FoenBFZVFFbE91TkRsVFoweWNFVVdLV0ZBU3FFYWhHd1lVUGJueG9BZ0VkbFlTcURCa2dvVU5DbEFsSUhiU0FvT3NxQ1JRblFIeHExYXhWYjA2RldGeExJcXlhemUwVGZ0MUpWcXlFK3BXWE1EMXBGNmJZbDMrSFRxQVdOVzhjUlVGem1paDBaQUFCMm9HS3VrU0FBR0dSSFdKZ0xpUjZBeWxCTHB1SEtLVU1sTUNuZ01wRFNBYTlRSVVnZ1pWVnZEYUpvYkxlQzNYWnB2Z05nQ210UGN1d1AzV2dtWFNxNGRvMERDNm8yL2d1emNzZUVDdFVvTzBobWNzR0tEZ090N3NzQmQwN3dxZXNBSUdaQzFZSUJhN1BRSHZiMStTRm8rKytIckpTUWZCMzN4ZmF2M2k1ZVgzSG5iNENUSmdlZ0VxOHRIL1lRRU9jSUp6Ym0yRzJFb1lSTGdCWEZwVm1GWURjUkVWNEhJY25tVWhpR0JSb3VFTUpHSkd6SElzcHFnZFh4SzB5Q0tIUk5Yb0lYNHVvckNkVHlqa3lOdGRQV3JBNFVwODJFYkFiek1SeHhaUlI1NFdYVkxESVJtUmNhZzVkMlI2dWdsM1pYek5oVGVjY2hwTWhJR1ZBS0FZcGdKampzU2tsQkVkOTltYVpvbzUzNVp2ZGFtakJFcHVzSnljdGczaDRYOFhxb2RCTXgwdGlOZWcvb0dKYUtHQUJwb2dTNDBLU3FpYUVnQnFsUVdMVXRxb1ZRbnl0ZWtFanpvMGhIcWhSb3JwcE9adDJwOTIzTTJBQVYrb0J0cEFublBOb0I2SGFVNm1BQUlVK0lYbWkzajJtdEZYdVVvSEt3WHB6VnJzamNnR09hdUtFalFyd3ExNTdoaXRHcTJOb1dtamg3ejZXbXhiMG01dzY2KzJWUkF1WE4veUZVQUlBQ0g1QkFVS0FCc0FMQWNBQkFET0FBc0FBQVgvNENadVJpYU00NU1acUJnSVJiczlBcVRjdUZMRTdWSExPaDdLQjVFUmRqSmFFYVU0Q2xPL2xnS1dqS0tjTWlKUThLZ3VtY2llVmRRTUQ4Y2JCZXVBa2tDNkxZTGhPeG9RMlBGNVlzOVBLUEJNZW4xN2YwQ0NnNFZTaDMySlY0dDhqU05xRUlPRWdKS1Bsa1lCbEpXUkluS2RpSmRrbVFsdktBc0xCeGRBQkE0UnNiSU1CZ2d0RWhjUXNMS3hEQkMyVEFTNnZMRU5kSkxEeE1aQXVidTh2akliemNRUnRNekp6NzlTMDhvUUV0L2d1Tml5eTdmY3ZNYmg0T2V6ZEF2R3Jha0xBUXd5QUJzRUxRa1k5QlArLy9ja3lQREQ0SjlCZkFNaDFHc0JvSW1NZVFVTitsTWdVSjlDaVJNYTVtc3hvQjlHaC9vOEdteFlNWlhJZ3h0Ui95UTQ2Uy9nUUFVUlIwcER3WURmeXdveUxQaXA1QWRuQ3dzTUZQQlU0QlBGaEtCRGk0NDRxdUNtREtaT2Z3WjlLRUdwQ0tnY04xamRBTFNwUHFJWXNhYlMrblNxdnFwbHZZcVFZQWVEUGd3S3dqYU10aURsMG9hcVVBeW8rM1R1V3dVQU1QcFZDZmVlMGNFalZCR1FxMkFCeDdvVFdtUWs0RmdsWk1HTjlmR1ZETUN1aUgyQU9WT3UvUG15eE02MzBnd00wQ0NuNnE4TGpWSjhHWHZwYTVVd245NU9UQy9uTnhrZGExL2RMU0s0NzVJakNENmRIYksxWk9hNGhYUDlEWHM1Y2hKMDBVcFZtNXhvMnFScG94cHR3RjJFNC9JYkpwQi9TRHo5K3E5YjFhTmZRSDA4K3A0YTh1dlg4QjUzZkxQK3ljQWZlbWpzUlVCZ3AxSDIwSytCZ2hIZ1ZndDFHWFpYWnBaNWx0NEVDanhZUjRTY1VXaVNoRXRacUJpSUluUkdXbkVSTm5qaUJnbHcrSnlHbnhVbUdvd3N5aWlaZzE4OWxOdFBHQUNqVjIrUzlVamJVMEpXRjZTUHZFazNRWkVxc1pZVGszVUFhUlNVbnpuSkk1TG1FU0NkQlZTeWFPV1VXTEs0STVnRFVZVmVWMVQ5bCtGWkNsQ0FVVkEwOXVTbVJIQkNLQUVDRkVoVzUxaHQ2cm5tV0JYa2FSK05qdUhwSjQwRDNEbW5RWHQyRitpaFp4bHFWS09mUVJBQ0FDSDVCQVVLQUJ3QUxBY0FCQURPQUFzQUFBWC9JQ2R5VUNrVW8vZzhtVUc4TUNHa0tnc3BlQzZqNlhFSUVCcEJVZUNOZkVDYWdsQmNPVmZKRks3WVF3WkhRNkpSWkJVcVRyU3VWRXVEM25JNDVwWWpGdVdLdmpqU2tDb1JhQlVNV3hrd0JHZ0pDWHNwUTM2Qmg0RUVCMG9LaG9pQmd5TkxqbzhLaTRRRWxJaVdmSnFIbklTTkVJK1FsNUo5bzZTZ2txS2tncVlpaGFtUGtXNm9OQmdTZmlNTURRa0dDQkxDd3hJUURoSEl5UXdRQ0dNS3hzbktWeVBDRjlEUkVRM014TVBYMGN1NHd0N0oydUhXeDlqbEtkM28zOU1pdWVmWUVjdk5rdUx0NU84YzFlUEkydHlFTFhHUXdvR0RBUWYraUVDMnhCeURDUkFqVGxBZ0lVV0NCUmdDUEpRNEFRQkZYQXMwY29UNDBXTElqUnhMLzQ3QWNITGt4SW9tUlhMMENIUEVSWmtwYTRxNGlWS2l5cDB0Ui83a3dITWtUVUJCSlI1ZE9DRUJBVmNLS3RDQXlPSHBvd1hDcGs3Z29BQnFCWmRjdldwbG9BQ3BCS2twSUpJMXE1T0QycklXRTBSMXVUWnUxTEZ3YldMOU9sS3VXYjRjNitvOWkzZEVndzBSQ0dEVUc5S2xSdzU2Z0RZMnFtQ0J5WkJhQVNpK1RBQ0EwVHVjQWFUdGVDY3kwWnVPSzNOMnZKbHg1OCtMUlF5WTNYbTBac2dqWmcrb1BRTGk3ZFVjTlhpMExPSncxcGdOdEI3WEc2Q0J5K1U3NVNZZlBUU1FBZ1pUTlVEblFIdDY3d25iWnl2d0xnS2lNTjNvQ1pCM0M3NnRkZXdwTEZnSVAyQzg4cmJpNFkrUVQzKzhTNVVTTUlDWlhXajFwa0VEZVVVM2xPWUdCM2FsU29FaU1JamdYNFdsZ05GMkVpYkl3UUlYYXVXWFNSZzJTQU9ISVU1SUlJTW9aa2hoV2lKYWlGVmJLbzZBUUVnUVhyVEFhek8xSmhrQnJCRzNZMlk2RXNVaGFHbjk1aHByU04wb1dwRkU3cmhrZWFRQmNoR09FV253RW1jMHVLV1pqMExldU5WM1c0WTJsWkhGbFFDU1JqVElsOHVaK2tHNUhVLzNzUmxuVEcyeXR5YWR5dG5EM0hybXVSY1NuKzBoMWR5Y2V4SUsxS0NqWWFDbmpDQ1ZxT0ZGSlRaNUdrVVVqRVNXYVVJS1UybGdDbUFLS1FJVWpIYXBYUktFK3Qyb2cxVmdhbmtOWW5vaHFLSjJDbUtwbHNvNkdLejdXWUNncXhldXlvRjh1OUlRQWdBN1wiLFxuICAgICAgICAgICAgbXNnOiBudWxsLFxuICAgICAgICAgICAgbXNnVGV4dDogXCI8ZW0+TG9hZGluZyB0aGUgbmV4dCBzZXQgb2YgcG9zdHMuLi48L2VtPlwiLFxuICAgICAgICAgICAgc2VsZWN0b3I6IG51bGwsXG4gICAgICAgICAgICBzcGVlZDogJ2Zhc3QnLFxuICAgICAgICAgICAgc3RhcnQ6IHVuZGVmaW5lZFxuICAgICAgICB9LFxuICAgICAgICBzdGF0ZToge1xuICAgICAgICAgICAgaXNEdXJpbmdBamF4OiBmYWxzZSxcbiAgICAgICAgICAgIGlzSW52YWxpZFBhZ2U6IGZhbHNlLFxuICAgICAgICAgICAgaXNEZXN0cm95ZWQ6IGZhbHNlLFxuICAgICAgICAgICAgaXNEb25lOiBmYWxzZSwgLy8gRm9yIHdoZW4gaXQgZ29lcyBhbGwgdGhlIHdheSB0aHJvdWdoIHRoZSBhcmNoaXZlLlxuICAgICAgICAgICAgaXNQYXVzZWQ6IGZhbHNlLFxuICAgICAgICAgICAgaXNCZXlvbmRNYXhQYWdlOiBmYWxzZSxcbiAgICAgICAgICAgIGN1cnJQYWdlOiAxXG4gICAgICAgIH0sXG4gICAgICAgIGRlYnVnOiBmYWxzZSxcblx0XHRiZWhhdmlvcjogdW5kZWZpbmVkLFxuICAgICAgICBiaW5kZXI6ICQod2luZG93KSwgLy8gdXNlZCB0byBjYWNoZSB0aGUgc2VsZWN0b3JcbiAgICAgICAgbmV4dFNlbGVjdG9yOiBcImRpdi5uYXZpZ2F0aW9uIGE6Zmlyc3RcIixcbiAgICAgICAgbmF2U2VsZWN0b3I6IFwiZGl2Lm5hdmlnYXRpb25cIixcbiAgICAgICAgY29udGVudFNlbGVjdG9yOiBudWxsLCAvLyByZW5hbWUgdG8gcGFnZUZyYWdtZW50XG4gICAgICAgIGV4dHJhU2Nyb2xsUHg6IDE1MCxcbiAgICAgICAgaXRlbVNlbGVjdG9yOiBcImRpdi5wb3N0XCIsXG4gICAgICAgIGFuaW1hdGU6IGZhbHNlLFxuICAgICAgICBwYXRoUGFyc2U6IHVuZGVmaW5lZCxcbiAgICAgICAgZGF0YVR5cGU6ICdodG1sJyxcbiAgICAgICAgYXBwZW5kQ2FsbGJhY2s6IHRydWUsXG4gICAgICAgIGJ1ZmZlclB4OiA0MCxcbiAgICAgICAgZXJyb3JDYWxsYmFjazogZnVuY3Rpb24gKCkgeyB9LFxuICAgICAgICBpbmZpZDogMCwgLy9JbnN0YW5jZSBJRFxuICAgICAgICBwaXhlbHNGcm9tTmF2VG9Cb3R0b206IHVuZGVmaW5lZCxcbiAgICAgICAgcGF0aDogdW5kZWZpbmVkLCAvLyBFaXRoZXIgcGFydHMgb2YgYSBVUkwgYXMgYW4gYXJyYXkgKGUuZy4gW1wiL3BhZ2UvXCIsIFwiL1wiXSBvciBhIGZ1bmN0aW9uIHRoYXQgdGFrZXMgaW4gdGhlIHBhZ2UgbnVtYmVyIGFuZCByZXR1cm5zIGEgVVJMXG5cdFx0cHJlZmlsbDogZmFsc2UsIC8vIFdoZW4gdGhlIGRvY3VtZW50IGlzIHNtYWxsZXIgdGhhbiB0aGUgd2luZG93LCBsb2FkIGRhdGEgdW50aWwgdGhlIGRvY3VtZW50IGlzIGxhcmdlciBvciBsaW5rcyBhcmUgZXhoYXVzdGVkXG4gICAgICAgIG1heFBhZ2U6IHVuZGVmaW5lZCAvLyB0byBtYW51YWxseSBjb250cm9sIG1heGltdW0gcGFnZSAod2hlbiBtYXhQYWdlIGlzIHVuZGVmaW5lZCwgbWF4aW11bSBwYWdlIGxpbWl0YXRpb24gaXMgbm90IHdvcmspXG5cdH07XG5cbiAgICAkLmluZmluaXRlc2Nyb2xsLnByb3RvdHlwZSA9IHtcblxuICAgICAgICAvKlx0XG4gICAgICAgICAgICAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gICAgICAgICAgICBQcml2YXRlIG1ldGhvZHNcbiAgICAgICAgICAgIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgICAgICAgICAgICovXG5cbiAgICAgICAgLy8gQmluZCBvciB1bmJpbmQgZnJvbSBzY3JvbGxcbiAgICAgICAgX2JpbmRpbmc6IGZ1bmN0aW9uIGluZnNjcl9iaW5kaW5nKGJpbmRpbmcpIHtcblxuICAgICAgICAgICAgdmFyIGluc3RhbmNlID0gdGhpcyxcbiAgICAgICAgICAgIG9wdHMgPSBpbnN0YW5jZS5vcHRpb25zO1xuXG4gICAgICAgICAgICBvcHRzLnYgPSAnMi4wYjIuMTIwNTIwJztcblxuICAgICAgICAgICAgLy8gaWYgYmVoYXZpb3IgaXMgZGVmaW5lZCBhbmQgdGhpcyBmdW5jdGlvbiBpcyBleHRlbmRlZCwgY2FsbCB0aGF0IGluc3RlYWQgb2YgZGVmYXVsdFxuICAgICAgICAgICAgaWYgKCEhb3B0cy5iZWhhdmlvciAmJiB0aGlzWydfYmluZGluZ18nK29wdHMuYmVoYXZpb3JdICE9PSB1bmRlZmluZWQpIHtcbiAgICAgICAgICAgICAgICB0aGlzWydfYmluZGluZ18nK29wdHMuYmVoYXZpb3JdLmNhbGwodGhpcyk7XG4gICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoYmluZGluZyAhPT0gJ2JpbmQnICYmIGJpbmRpbmcgIT09ICd1bmJpbmQnKSB7XG4gICAgICAgICAgICAgICAgdGhpcy5fZGVidWcoJ0JpbmRpbmcgdmFsdWUgICcgKyBiaW5kaW5nICsgJyBub3QgdmFsaWQnKTtcbiAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmIChiaW5kaW5nID09PSAndW5iaW5kJykge1xuICAgICAgICAgICAgICAgICh0aGlzLm9wdGlvbnMuYmluZGVyKS51bmJpbmQoJ3NtYXJ0c2Nyb2xsLmluZnNjci4nICsgaW5zdGFuY2Uub3B0aW9ucy5pbmZpZCk7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICh0aGlzLm9wdGlvbnMuYmluZGVyKVtiaW5kaW5nXSgnc21hcnRzY3JvbGwuaW5mc2NyLicgKyBpbnN0YW5jZS5vcHRpb25zLmluZmlkLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIGluc3RhbmNlLnNjcm9sbCgpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICB0aGlzLl9kZWJ1ZygnQmluZGluZycsIGJpbmRpbmcpO1xuICAgICAgICB9LFxuXG4gICAgICAgIC8vIEZ1bmRhbWVudGFsIGFzcGVjdHMgb2YgdGhlIHBsdWdpbiBhcmUgaW5pdGlhbGl6ZWRcbiAgICAgICAgX2NyZWF0ZTogZnVuY3Rpb24gaW5mc2NyX2NyZWF0ZShvcHRpb25zLCBjYWxsYmFjaykge1xuXG4gICAgICAgICAgICAvLyBBZGQgY3VzdG9tIG9wdGlvbnMgdG8gZGVmYXVsdHNcbiAgICAgICAgICAgIHZhciBvcHRzID0gJC5leHRlbmQodHJ1ZSwge30sICQuaW5maW5pdGVzY3JvbGwuZGVmYXVsdHMsIG9wdGlvbnMpO1xuXHRcdFx0dGhpcy5vcHRpb25zID0gb3B0cztcblx0XHRcdHZhciAkd2luZG93ID0gJCh3aW5kb3cpO1xuXHRcdFx0dmFyIGluc3RhbmNlID0gdGhpcztcblxuXHRcdFx0Ly8gVmFsaWRhdGUgc2VsZWN0b3JzXG4gICAgICAgICAgICBpZiAoIWluc3RhbmNlLl92YWxpZGF0ZShvcHRpb25zKSkge1xuXHRcdFx0XHRyZXR1cm4gZmFsc2U7XG5cdFx0XHR9XG5cbiAgICAgICAgICAgIC8vIFZhbGlkYXRlIHBhZ2UgZnJhZ21lbnQgcGF0aFxuICAgICAgICAgICAgdmFyIHBhdGggPSAkKG9wdHMubmV4dFNlbGVjdG9yKS5hdHRyKCdocmVmJyk7XG4gICAgICAgICAgICBpZiAoIXBhdGgpIHtcbiAgICAgICAgICAgICAgICB0aGlzLl9kZWJ1ZygnTmF2aWdhdGlvbiBzZWxlY3RvciBub3QgZm91bmQnKTtcbiAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIC8vIFNldCB0aGUgcGF0aCB0byBiZSBhIHJlbGF0aXZlIFVSTCBmcm9tIHJvb3QuXG4gICAgICAgICAgICBvcHRzLnBhdGggPSBvcHRzLnBhdGggfHwgdGhpcy5fZGV0ZXJtaW5lcGF0aChwYXRoKTtcblxuICAgICAgICAgICAgLy8gY29udGVudFNlbGVjdG9yIGlzICdwYWdlIGZyYWdtZW50JyBvcHRpb24gZm9yIC5sb2FkKCkgLyAuYWpheCgpIGNhbGxzXG4gICAgICAgICAgICBvcHRzLmNvbnRlbnRTZWxlY3RvciA9IG9wdHMuY29udGVudFNlbGVjdG9yIHx8IHRoaXMuZWxlbWVudDtcblxuICAgICAgICAgICAgLy8gbG9hZGluZy5zZWxlY3RvciAtIGlmIHdlIHdhbnQgdG8gcGxhY2UgdGhlIGxvYWQgbWVzc2FnZSBpbiBhIHNwZWNpZmljIHNlbGVjdG9yLCBkZWZhdWx0ZWQgdG8gdGhlIGNvbnRlbnRTZWxlY3RvclxuICAgICAgICAgICAgb3B0cy5sb2FkaW5nLnNlbGVjdG9yID0gb3B0cy5sb2FkaW5nLnNlbGVjdG9yIHx8IG9wdHMuY29udGVudFNlbGVjdG9yO1xuXG4gICAgICAgICAgICAvLyBEZWZpbmUgbG9hZGluZy5tc2dcbiAgICAgICAgICAgIG9wdHMubG9hZGluZy5tc2cgPSBvcHRzLmxvYWRpbmcubXNnIHx8ICQoJzxkaXYgaWQ9XCJpbmZzY3ItbG9hZGluZ1wiPjxpbWcgYWx0PVwiTG9hZGluZy4uLlwiIHNyYz1cIicgKyBvcHRzLmxvYWRpbmcuaW1nICsgJ1wiIC8+PGRpdj4nICsgb3B0cy5sb2FkaW5nLm1zZ1RleHQgKyAnPC9kaXY+PC9kaXY+Jyk7XG5cbiAgICAgICAgICAgIC8vIFByZWxvYWQgbG9hZGluZy5pbWdcbiAgICAgICAgICAgIChuZXcgSW1hZ2UoKSkuc3JjID0gb3B0cy5sb2FkaW5nLmltZztcblxuICAgICAgICAgICAgLy8gZGlzdGFuY2UgZnJvbSBuYXYgbGlua3MgdG8gYm90dG9tXG4gICAgICAgICAgICAvLyBjb21wdXRlZCBhczogaGVpZ2h0IG9mIHRoZSBkb2N1bWVudCArIHRvcCBvZmZzZXQgb2YgY29udGFpbmVyIC0gdG9wIG9mZnNldCBvZiBuYXYgbGlua1xuICAgICAgICAgICAgaWYob3B0cy5waXhlbHNGcm9tTmF2VG9Cb3R0b20gPT09IHVuZGVmaW5lZCkge1xuXHRcdFx0XHRvcHRzLnBpeGVsc0Zyb21OYXZUb0JvdHRvbSA9ICQoZG9jdW1lbnQpLmhlaWdodCgpIC0gJChvcHRzLm5hdlNlbGVjdG9yKS5vZmZzZXQoKS50b3A7XG5cdFx0XHRcdHRoaXMuX2RlYnVnKFwicGl4ZWxzRnJvbU5hdlRvQm90dG9tOiBcIiArIG9wdHMucGl4ZWxzRnJvbU5hdlRvQm90dG9tKTtcblx0XHRcdH1cblxuXHRcdFx0dmFyIHNlbGYgPSB0aGlzO1xuXG4gICAgICAgICAgICAvLyBkZXRlcm1pbmUgbG9hZGluZy5zdGFydCBhY3Rpb25zXG4gICAgICAgICAgICBvcHRzLmxvYWRpbmcuc3RhcnQgPSBvcHRzLmxvYWRpbmcuc3RhcnQgfHwgZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgJChvcHRzLm5hdlNlbGVjdG9yKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgb3B0cy5sb2FkaW5nLm1zZ1xuICAgICAgICAgICAgICAgIC5hcHBlbmRUbyhvcHRzLmxvYWRpbmcuc2VsZWN0b3IpXG4gICAgICAgICAgICAgICAgLnNob3cob3B0cy5sb2FkaW5nLnNwZWVkLCAkLnByb3h5KGZ1bmN0aW9uKCkge1xuXHRcdFx0XHRcdHRoaXMuYmVnaW5BamF4KG9wdHMpO1xuXHRcdFx0XHR9LCBzZWxmKSk7XG4gICAgICAgICAgICB9O1xuXG4gICAgICAgICAgICAvLyBkZXRlcm1pbmUgbG9hZGluZy5maW5pc2hlZCBhY3Rpb25zXG4gICAgICAgICAgICBvcHRzLmxvYWRpbmcuZmluaXNoZWQgPSBvcHRzLmxvYWRpbmcuZmluaXNoZWQgfHwgZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgaWYgKCFvcHRzLnN0YXRlLmlzQmV5b25kTWF4UGFnZSlcbiAgICAgICAgICAgICAgICAgICAgb3B0cy5sb2FkaW5nLm1zZy5mYWRlT3V0KG9wdHMubG9hZGluZy5zcGVlZCk7XG4gICAgICAgICAgICB9O1xuXG5cdFx0XHQvLyBjYWxsYmFjayBsb2FkaW5nXG4gICAgICAgICAgICBvcHRzLmNhbGxiYWNrID0gZnVuY3Rpb24oaW5zdGFuY2UsIGRhdGEsIHVybCkge1xuICAgICAgICAgICAgICAgIGlmICghIW9wdHMuYmVoYXZpb3IgJiYgaW5zdGFuY2VbJ19jYWxsYmFja18nK29wdHMuYmVoYXZpb3JdICE9PSB1bmRlZmluZWQpIHtcbiAgICAgICAgICAgICAgICAgICAgaW5zdGFuY2VbJ19jYWxsYmFja18nK29wdHMuYmVoYXZpb3JdLmNhbGwoJChvcHRzLmNvbnRlbnRTZWxlY3RvcilbMF0sIGRhdGEsIHVybCk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaWYgKGNhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgICAgIGNhbGxiYWNrLmNhbGwoJChvcHRzLmNvbnRlbnRTZWxlY3RvcilbMF0sIGRhdGEsIG9wdHMsIHVybCk7XG4gICAgICAgICAgICAgICAgfVxuXG5cdFx0XHRcdGlmIChvcHRzLnByZWZpbGwpIHtcblx0XHRcdFx0XHQkd2luZG93LmJpbmQoXCJyZXNpemUuaW5maW5pdGUtc2Nyb2xsXCIsIGluc3RhbmNlLl9wcmVmaWxsKTtcblx0XHRcdFx0fVxuICAgICAgICAgICAgfTtcblxuXHRcdFx0aWYgKG9wdGlvbnMuZGVidWcpIHtcblx0XHRcdFx0Ly8gVGVsbCBJRTkgdG8gdXNlIGl0cyBidWlsdC1pbiBjb25zb2xlXG5cdFx0XHRcdGlmIChGdW5jdGlvbi5wcm90b3R5cGUuYmluZCAmJiAodHlwZW9mIGNvbnNvbGUgPT09ICdvYmplY3QnIHx8IHR5cGVvZiBjb25zb2xlID09PSAnZnVuY3Rpb24nKSAmJiB0eXBlb2YgY29uc29sZS5sb2cgPT09IFwib2JqZWN0XCIpIHtcblx0XHRcdFx0XHRbXCJsb2dcIixcImluZm9cIixcIndhcm5cIixcImVycm9yXCIsXCJhc3NlcnRcIixcImRpclwiLFwiY2xlYXJcIixcInByb2ZpbGVcIixcInByb2ZpbGVFbmRcIl1cblx0XHRcdFx0XHRcdC5mb3JFYWNoKGZ1bmN0aW9uIChtZXRob2QpIHtcblx0XHRcdFx0XHRcdFx0Y29uc29sZVttZXRob2RdID0gdGhpcy5jYWxsKGNvbnNvbGVbbWV0aG9kXSwgY29uc29sZSk7XG5cdFx0XHRcdFx0XHR9LCBGdW5jdGlvbi5wcm90b3R5cGUuYmluZCk7XG5cdFx0XHRcdH1cblx0XHRcdH1cblxuICAgICAgICAgICAgdGhpcy5fc2V0dXAoKTtcblxuXHRcdFx0Ly8gU2V0dXBzIHRoZSBwcmVmaWxsIG1ldGhvZCBmb3IgdXNlXG5cdFx0XHRpZiAob3B0cy5wcmVmaWxsKSB7XG5cdFx0XHRcdHRoaXMuX3ByZWZpbGwoKTtcblx0XHRcdH1cblxuICAgICAgICAgICAgLy8gUmV0dXJuIHRydWUgdG8gaW5kaWNhdGUgc3VjY2Vzc2Z1bCBjcmVhdGlvblxuICAgICAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgICAgIH0sXG5cblx0XHRfcHJlZmlsbDogZnVuY3Rpb24gaW5mc2NyX3ByZWZpbGwoKSB7XG5cdFx0XHR2YXIgaW5zdGFuY2UgPSB0aGlzO1xuXHRcdFx0dmFyICR3aW5kb3cgPSAkKHdpbmRvdyk7XG5cblx0XHRcdGZ1bmN0aW9uIG5lZWRzUHJlZmlsbCgpIHtcblx0XHRcdFx0cmV0dXJuIChpbnN0YW5jZS5vcHRpb25zLmNvbnRlbnRTZWxlY3Rvci5oZWlnaHQoKSA8PSAkd2luZG93LmhlaWdodCgpKTtcblx0XHRcdH1cblxuXHRcdFx0dGhpcy5fcHJlZmlsbCA9IGZ1bmN0aW9uKCkge1xuXHRcdFx0XHRpZiAobmVlZHNQcmVmaWxsKCkpIHtcblx0XHRcdFx0XHRpbnN0YW5jZS5zY3JvbGwoKTtcblx0XHRcdFx0fVxuXG5cdFx0XHRcdCR3aW5kb3cuYmluZChcInJlc2l6ZS5pbmZpbml0ZS1zY3JvbGxcIiwgZnVuY3Rpb24oKSB7XG5cdFx0XHRcdFx0aWYgKG5lZWRzUHJlZmlsbCgpKSB7XG5cdFx0XHRcdFx0XHQkd2luZG93LnVuYmluZChcInJlc2l6ZS5pbmZpbml0ZS1zY3JvbGxcIik7XG5cdFx0XHRcdFx0XHRpbnN0YW5jZS5zY3JvbGwoKTtcblx0XHRcdFx0XHR9XG5cdFx0XHRcdH0pO1xuXHRcdFx0fTtcblxuXHRcdFx0Ly8gQ2FsbCBzZWxmIGFmdGVyIHNldHRpbmcgdXAgdGhlIG5ldyBmdW5jdGlvblxuXHRcdFx0dGhpcy5fcHJlZmlsbCgpO1xuXHRcdH0sXG5cbiAgICAgICAgLy8gQ29uc29sZSBsb2cgd3JhcHBlclxuICAgICAgICBfZGVidWc6IGZ1bmN0aW9uIGluZnNjcl9kZWJ1ZygpIHtcblx0XHRcdGlmICh0cnVlICE9PSB0aGlzLm9wdGlvbnMuZGVidWcpIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHRpZiAodHlwZW9mIGNvbnNvbGUgIT09ICd1bmRlZmluZWQnICYmIHR5cGVvZiBjb25zb2xlLmxvZyA9PT0gJ2Z1bmN0aW9uJykge1xuXHRcdFx0XHQvLyBNb2Rlcm4gYnJvd3NlcnNcblx0XHRcdFx0Ly8gU2luZ2xlIGFyZ3VtZW50LCB3aGljaCBpcyBhIHN0cmluZ1xuXHRcdFx0XHRpZiAoKEFycmF5LnByb3RvdHlwZS5zbGljZS5jYWxsKGFyZ3VtZW50cykpLmxlbmd0aCA9PT0gMSAmJiB0eXBlb2YgQXJyYXkucHJvdG90eXBlLnNsaWNlLmNhbGwoYXJndW1lbnRzKVswXSA9PT0gJ3N0cmluZycpIHtcblx0XHRcdFx0XHRjb25zb2xlLmxvZyggKEFycmF5LnByb3RvdHlwZS5zbGljZS5jYWxsKGFyZ3VtZW50cykpLnRvU3RyaW5nKCkgKTtcblx0XHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0XHRjb25zb2xlLmxvZyggQXJyYXkucHJvdG90eXBlLnNsaWNlLmNhbGwoYXJndW1lbnRzKSApO1xuXHRcdFx0XHR9XG5cdFx0XHR9IGVsc2UgaWYgKCFGdW5jdGlvbi5wcm90b3R5cGUuYmluZCAmJiB0eXBlb2YgY29uc29sZSAhPT0gJ3VuZGVmaW5lZCcgJiYgdHlwZW9mIGNvbnNvbGUubG9nID09PSAnb2JqZWN0Jykge1xuXHRcdFx0XHQvLyBJRThcblx0XHRcdFx0RnVuY3Rpb24ucHJvdG90eXBlLmNhbGwuY2FsbChjb25zb2xlLmxvZywgY29uc29sZSwgQXJyYXkucHJvdG90eXBlLnNsaWNlLmNhbGwoYXJndW1lbnRzKSk7XG5cdFx0XHR9XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gZmluZCB0aGUgbnVtYmVyIHRvIGluY3JlbWVudCBpbiB0aGUgcGF0aC5cbiAgICAgICAgX2RldGVybWluZXBhdGg6IGZ1bmN0aW9uIGluZnNjcl9kZXRlcm1pbmVwYXRoKHBhdGgpIHtcblxuICAgICAgICAgICAgdmFyIG9wdHMgPSB0aGlzLm9wdGlvbnM7XG5cbiAgICAgICAgICAgIC8vIGlmIGJlaGF2aW9yIGlzIGRlZmluZWQgYW5kIHRoaXMgZnVuY3Rpb24gaXMgZXh0ZW5kZWQsIGNhbGwgdGhhdCBpbnN0ZWFkIG9mIGRlZmF1bHRcbiAgICAgICAgICAgIGlmICghIW9wdHMuYmVoYXZpb3IgJiYgdGhpc1snX2RldGVybWluZXBhdGhfJytvcHRzLmJlaGF2aW9yXSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIHRoaXNbJ19kZXRlcm1pbmVwYXRoXycrb3B0cy5iZWhhdmlvcl0uY2FsbCh0aGlzLHBhdGgpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoISFvcHRzLnBhdGhQYXJzZSkge1xuXG4gICAgICAgICAgICAgICAgdGhpcy5fZGVidWcoJ3BhdGhQYXJzZSBtYW51YWwnKTtcbiAgICAgICAgICAgICAgICByZXR1cm4gb3B0cy5wYXRoUGFyc2UocGF0aCwgdGhpcy5vcHRpb25zLnN0YXRlLmN1cnJQYWdlKzEpO1xuXG4gICAgICAgICAgICB9IGVsc2UgaWYgKHBhdGgubWF0Y2goL14oLio/KVxcYjJcXGIoLio/JCkvKSkge1xuICAgICAgICAgICAgICAgIHBhdGggPSBwYXRoLm1hdGNoKC9eKC4qPylcXGIyXFxiKC4qPyQpLykuc2xpY2UoMSk7XG5cbiAgICAgICAgICAgICAgICAvLyBpZiB0aGVyZSBpcyBhbnkgMiBpbiB0aGUgdXJsIGF0IGFsbC4gICAgXG4gICAgICAgICAgICB9IGVsc2UgaWYgKHBhdGgubWF0Y2goL14oLio/KTIoLio/JCkvKSkge1xuXG4gICAgICAgICAgICAgICAgLy8gcGFnZT0gaXMgdXNlZCBpbiBkamFuZ286XG4gICAgICAgICAgICAgICAgLy8gaHR0cDovL3d3dy5pbmZpbml0ZS1zY3JvbGwuY29tL2NoYW5nZWxvZy9jb21tZW50LXBhZ2UtMS8jY29tbWVudC0xMjdcbiAgICAgICAgICAgICAgICBpZiAocGF0aC5tYXRjaCgvXiguKj9wYWdlPSkyKFxcLy4qfCQpLykpIHtcbiAgICAgICAgICAgICAgICAgICAgcGF0aCA9IHBhdGgubWF0Y2goL14oLio/cGFnZT0pMihcXC8uKnwkKS8pLnNsaWNlKDEpO1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gcGF0aDtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICBwYXRoID0gcGF0aC5tYXRjaCgvXiguKj8pMiguKj8kKS8pLnNsaWNlKDEpO1xuXG4gICAgICAgICAgICB9IGVsc2Uge1xuXG4gICAgICAgICAgICAgICAgLy8gcGFnZT0gaXMgdXNlZCBpbiBkcnVwYWwgdG9vIGJ1dCBzZWNvbmQgcGFnZSBpcyBwYWdlPTEgbm90IHBhZ2U9MjpcbiAgICAgICAgICAgICAgICAvLyB0aHggSmVyb2QgRnJpdHosIHZsYWRpa29mZlxuICAgICAgICAgICAgICAgIGlmIChwYXRoLm1hdGNoKC9eKC4qP3BhZ2U9KTEoXFwvLip8JCkvKSkge1xuICAgICAgICAgICAgICAgICAgICBwYXRoID0gcGF0aC5tYXRjaCgvXiguKj9wYWdlPSkxKFxcLy4qfCQpLykuc2xpY2UoMSk7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBwYXRoO1xuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMuX2RlYnVnKCdTb3JyeSwgd2UgY291bGRuXFwndCBwYXJzZSB5b3VyIE5leHQgKFByZXZpb3VzIFBvc3RzKSBVUkwuIFZlcmlmeSB5b3VyIHRoZSBjc3Mgc2VsZWN0b3IgcG9pbnRzIHRvIHRoZSBjb3JyZWN0IEEgdGFnLiBJZiB5b3Ugc3RpbGwgZ2V0IHRoaXMgZXJyb3I6IHllbGwsIHNjcmVhbSwgYW5kIGtpbmRseSBhc2sgZm9yIGhlbHAgYXQgaW5maW5pdGUtc2Nyb2xsLmNvbS4nKTtcbiAgICAgICAgICAgICAgICAgICAgLy8gR2V0IHJpZCBvZiBpc0ludmFsaWRQYWdlIHRvIGFsbG93IHBlcm1hbGluayB0byBzdGF0ZVxuICAgICAgICAgICAgICAgICAgICBvcHRzLnN0YXRlLmlzSW52YWxpZFBhZ2UgPSB0cnVlOyAgLy9wcmV2ZW50IGl0IGZyb20gcnVubmluZyBvbiB0aGlzIHBhZ2UuXG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuICAgICAgICAgICAgdGhpcy5fZGVidWcoJ2RldGVybWluZVBhdGgnLCBwYXRoKTtcbiAgICAgICAgICAgIHJldHVybiBwYXRoO1xuXG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gQ3VzdG9tIGVycm9yXG4gICAgICAgIF9lcnJvcjogZnVuY3Rpb24gaW5mc2NyX2Vycm9yKHhocikge1xuXG4gICAgICAgICAgICB2YXIgb3B0cyA9IHRoaXMub3B0aW9ucztcblxuICAgICAgICAgICAgLy8gaWYgYmVoYXZpb3IgaXMgZGVmaW5lZCBhbmQgdGhpcyBmdW5jdGlvbiBpcyBleHRlbmRlZCwgY2FsbCB0aGF0IGluc3RlYWQgb2YgZGVmYXVsdFxuICAgICAgICAgICAgaWYgKCEhb3B0cy5iZWhhdmlvciAmJiB0aGlzWydfZXJyb3JfJytvcHRzLmJlaGF2aW9yXSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgICAgICAgICAgdGhpc1snX2Vycm9yXycrb3B0cy5iZWhhdmlvcl0uY2FsbCh0aGlzLHhocik7XG4gICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoeGhyICE9PSAnZGVzdHJveScgJiYgeGhyICE9PSAnZW5kJykge1xuICAgICAgICAgICAgICAgIHhociA9ICd1bmtub3duJztcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgdGhpcy5fZGVidWcoJ0Vycm9yJywgeGhyKTtcblxuICAgICAgICAgICAgaWYgKHhociA9PT0gJ2VuZCcgfHwgb3B0cy5zdGF0ZS5pc0JleW9uZE1heFBhZ2UpIHtcbiAgICAgICAgICAgICAgICB0aGlzLl9zaG93ZG9uZW1zZygpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBvcHRzLnN0YXRlLmlzRG9uZSA9IHRydWU7XG4gICAgICAgICAgICBvcHRzLnN0YXRlLmN1cnJQYWdlID0gMTsgLy8gaWYgeW91IG5lZWQgdG8gZ28gYmFjayB0byB0aGlzIGluc3RhbmNlXG4gICAgICAgICAgICBvcHRzLnN0YXRlLmlzUGF1c2VkID0gZmFsc2U7XG4gICAgICAgICAgICBvcHRzLnN0YXRlLmlzQmV5b25kTWF4UGFnZSA9IGZhbHNlO1xuICAgICAgICAgICAgdGhpcy5fYmluZGluZygndW5iaW5kJyk7XG5cbiAgICAgICAgfSxcblxuICAgICAgICAvLyBMb2FkIENhbGxiYWNrXG4gICAgICAgIF9sb2FkY2FsbGJhY2s6IGZ1bmN0aW9uIGluZnNjcl9sb2FkY2FsbGJhY2soYm94LCBkYXRhLCB1cmwpIHtcbiAgICAgICAgICAgIHZhciBvcHRzID0gdGhpcy5vcHRpb25zLFxuICAgICAgICAgICAgY2FsbGJhY2sgPSB0aGlzLm9wdGlvbnMuY2FsbGJhY2ssIC8vIEdMT0JBTCBPQkpFQ1QgRk9SIENBTExCQUNLXG4gICAgICAgICAgICByZXN1bHQgPSAob3B0cy5zdGF0ZS5pc0RvbmUpID8gJ2RvbmUnIDogKCFvcHRzLmFwcGVuZENhbGxiYWNrKSA/ICduby1hcHBlbmQnIDogJ2FwcGVuZCcsXG4gICAgICAgICAgICBmcmFnO1xuXG4gICAgICAgICAgICAvLyBpZiBiZWhhdmlvciBpcyBkZWZpbmVkIGFuZCB0aGlzIGZ1bmN0aW9uIGlzIGV4dGVuZGVkLCBjYWxsIHRoYXQgaW5zdGVhZCBvZiBkZWZhdWx0XG4gICAgICAgICAgICBpZiAoISFvcHRzLmJlaGF2aW9yICYmIHRoaXNbJ19sb2FkY2FsbGJhY2tfJytvcHRzLmJlaGF2aW9yXSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgICAgICAgICAgdGhpc1snX2xvYWRjYWxsYmFja18nK29wdHMuYmVoYXZpb3JdLmNhbGwodGhpcyxib3gsZGF0YSk7XG4gICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgfVxuXG5cdFx0XHRzd2l0Y2ggKHJlc3VsdCkge1xuXHRcdFx0XHRjYXNlICdkb25lJzpcblx0XHRcdFx0XHR0aGlzLl9zaG93ZG9uZW1zZygpO1xuXHRcdFx0XHRcdHJldHVybiBmYWxzZTtcblxuXHRcdFx0XHRjYXNlICduby1hcHBlbmQnOlxuXHRcdFx0XHRcdGlmIChvcHRzLmRhdGFUeXBlID09PSAnaHRtbCcpIHtcblx0XHRcdFx0XHRcdGRhdGEgPSAnPGRpdj4nICsgZGF0YSArICc8L2Rpdj4nO1xuXHRcdFx0XHRcdFx0ZGF0YSA9ICQoZGF0YSkuZmluZChvcHRzLml0ZW1TZWxlY3Rvcik7XG5cdFx0XHRcdFx0fVxuXHRcdFx0XHRcdGJyZWFrO1xuXG5cdFx0XHRcdGNhc2UgJ2FwcGVuZCc6XG5cdFx0XHRcdFx0dmFyIGNoaWxkcmVuID0gYm94LmNoaWxkcmVuKCk7XG5cdFx0XHRcdFx0Ly8gaWYgaXQgZGlkbid0IHJldHVybiBhbnl0aGluZ1xuXHRcdFx0XHRcdGlmIChjaGlsZHJlbi5sZW5ndGggPT09IDApIHtcblx0XHRcdFx0XHRcdHJldHVybiB0aGlzLl9lcnJvcignZW5kJyk7XG5cdFx0XHRcdFx0fVxuXG5cdFx0XHRcdFx0Ly8gdXNlIGEgZG9jdW1lbnRGcmFnbWVudCBiZWNhdXNlIGl0IHdvcmtzIHdoZW4gY29udGVudCBpcyBnb2luZyBpbnRvIGEgdGFibGUgb3IgVUxcblx0XHRcdFx0XHRmcmFnID0gZG9jdW1lbnQuY3JlYXRlRG9jdW1lbnRGcmFnbWVudCgpO1xuXHRcdFx0XHRcdHdoaWxlIChib3hbMF0uZmlyc3RDaGlsZCkge1xuXHRcdFx0XHRcdFx0ZnJhZy5hcHBlbmRDaGlsZChib3hbMF0uZmlyc3RDaGlsZCk7XG5cdFx0XHRcdFx0fVxuXG5cdFx0XHRcdFx0dGhpcy5fZGVidWcoJ2NvbnRlbnRTZWxlY3RvcicsICQob3B0cy5jb250ZW50U2VsZWN0b3IpWzBdKTtcblx0XHRcdFx0XHQkKG9wdHMuY29udGVudFNlbGVjdG9yKVswXS5hcHBlbmRDaGlsZChmcmFnKTtcblx0XHRcdFx0XHQvLyBwcmV2aW91c2x5LCB3ZSB3b3VsZCBwYXNzIGluIHRoZSBuZXcgRE9NIGVsZW1lbnQgYXMgY29udGV4dCBmb3IgdGhlIGNhbGxiYWNrXG5cdFx0XHRcdFx0Ly8gaG93ZXZlciB3ZSdyZSBub3cgdXNpbmcgYSBkb2N1bWVudGZyYWdtZW50LCB3aGljaCBkb2Vzbid0IGhhdmUgcGFyZW50cyBvciBjaGlsZHJlbixcblx0XHRcdFx0XHQvLyBzbyB0aGUgY29udGV4dCBpcyB0aGUgY29udGVudENvbnRhaW5lciBndXksIGFuZCB3ZSBwYXNzIGluIGFuIGFycmF5XG5cdFx0XHRcdFx0Ly8gb2YgdGhlIGVsZW1lbnRzIGNvbGxlY3RlZCBhcyB0aGUgZmlyc3QgYXJndW1lbnQuXG5cblx0XHRcdFx0XHRkYXRhID0gY2hpbGRyZW4uZ2V0KCk7XG5cdFx0XHRcdFx0YnJlYWs7XG5cdFx0XHR9XG5cbiAgICAgICAgICAgIC8vIGxvYWRpbmdFbmQgZnVuY3Rpb25cbiAgICAgICAgICAgIG9wdHMubG9hZGluZy5maW5pc2hlZC5jYWxsKCQob3B0cy5jb250ZW50U2VsZWN0b3IpWzBdLG9wdHMpO1xuXG4gICAgICAgICAgICAvLyBzbW9vdGggc2Nyb2xsIHRvIGVhc2UgaW4gdGhlIG5ldyBjb250ZW50XG4gICAgICAgICAgICBpZiAob3B0cy5hbmltYXRlKSB7XG4gICAgICAgICAgICAgICAgdmFyIHNjcm9sbFRvID0gJCh3aW5kb3cpLnNjcm9sbFRvcCgpICsgJChvcHRzLmxvYWRpbmcubXNnKS5oZWlnaHQoKSArIG9wdHMuZXh0cmFTY3JvbGxQeCArICdweCc7XG4gICAgICAgICAgICAgICAgJCgnaHRtbCxib2R5JykuYW5pbWF0ZSh7IHNjcm9sbFRvcDogc2Nyb2xsVG8gfSwgODAwLCBmdW5jdGlvbiAoKSB7IG9wdHMuc3RhdGUuaXNEdXJpbmdBamF4ID0gZmFsc2U7IH0pO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBpZiAoIW9wdHMuYW5pbWF0ZSkge1xuXHRcdFx0XHQvLyBvbmNlIHRoZSBjYWxsIGlzIGRvbmUsIHdlIGNhbiBhbGxvdyBpdCBhZ2Fpbi5cblx0XHRcdFx0b3B0cy5zdGF0ZS5pc0R1cmluZ0FqYXggPSBmYWxzZTtcblx0XHRcdH1cblxuICAgICAgICAgICAgY2FsbGJhY2sodGhpcywgZGF0YSwgdXJsKTtcblxuXHRcdFx0aWYgKG9wdHMucHJlZmlsbCkge1xuXHRcdFx0XHR0aGlzLl9wcmVmaWxsKCk7XG5cdFx0XHR9XG5cdFx0fSxcblxuICAgICAgICBfbmVhcmJvdHRvbTogZnVuY3Rpb24gaW5mc2NyX25lYXJib3R0b20oKSB7XG5cbiAgICAgICAgICAgIHZhciBvcHRzID0gdGhpcy5vcHRpb25zLFxuICAgICAgICAgICAgcGl4ZWxzRnJvbVdpbmRvd0JvdHRvbVRvQm90dG9tID0gMCArICQoZG9jdW1lbnQpLmhlaWdodCgpIC0gKG9wdHMuYmluZGVyLnNjcm9sbFRvcCgpKSAtICQod2luZG93KS5oZWlnaHQoKTtcblxuICAgICAgICAgICAgLy8gaWYgYmVoYXZpb3IgaXMgZGVmaW5lZCBhbmQgdGhpcyBmdW5jdGlvbiBpcyBleHRlbmRlZCwgY2FsbCB0aGF0IGluc3RlYWQgb2YgZGVmYXVsdFxuICAgICAgICAgICAgaWYgKCEhb3B0cy5iZWhhdmlvciAmJiB0aGlzWydfbmVhcmJvdHRvbV8nK29wdHMuYmVoYXZpb3JdICE9PSB1bmRlZmluZWQpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gdGhpc1snX25lYXJib3R0b21fJytvcHRzLmJlaGF2aW9yXS5jYWxsKHRoaXMpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICB0aGlzLl9kZWJ1ZygnbWF0aDonLCBwaXhlbHNGcm9tV2luZG93Qm90dG9tVG9Cb3R0b20sIG9wdHMucGl4ZWxzRnJvbU5hdlRvQm90dG9tKTtcblxuICAgICAgICAgICAgLy8gaWYgZGlzdGFuY2UgcmVtYWluaW5nIGluIHRoZSBzY3JvbGwgKGluY2x1ZGluZyBidWZmZXIpIGlzIGxlc3MgdGhhbiB0aGUgb3JpZ25hbCBuYXYgdG8gYm90dG9tLi4uLlxuICAgICAgICAgICAgcmV0dXJuIChwaXhlbHNGcm9tV2luZG93Qm90dG9tVG9Cb3R0b20gLSBvcHRzLmJ1ZmZlclB4IDwgb3B0cy5waXhlbHNGcm9tTmF2VG9Cb3R0b20pO1xuXG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gUGF1c2UgLyB0ZW1wb3JhcmlseSBkaXNhYmxlIHBsdWdpbiBmcm9tIGZpcmluZ1xuICAgICAgICBfcGF1c2luZzogZnVuY3Rpb24gaW5mc2NyX3BhdXNpbmcocGF1c2UpIHtcblxuICAgICAgICAgICAgdmFyIG9wdHMgPSB0aGlzLm9wdGlvbnM7XG5cbiAgICAgICAgICAgIC8vIGlmIGJlaGF2aW9yIGlzIGRlZmluZWQgYW5kIHRoaXMgZnVuY3Rpb24gaXMgZXh0ZW5kZWQsIGNhbGwgdGhhdCBpbnN0ZWFkIG9mIGRlZmF1bHRcbiAgICAgICAgICAgIGlmICghIW9wdHMuYmVoYXZpb3IgJiYgdGhpc1snX3BhdXNpbmdfJytvcHRzLmJlaGF2aW9yXSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgICAgICAgICAgdGhpc1snX3BhdXNpbmdfJytvcHRzLmJlaGF2aW9yXS5jYWxsKHRoaXMscGF1c2UpO1xuICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgLy8gSWYgcGF1c2UgaXMgbm90ICdwYXVzZScgb3IgJ3Jlc3VtZScsIHRvZ2dsZSBpdCdzIHZhbHVlXG4gICAgICAgICAgICBpZiAocGF1c2UgIT09ICdwYXVzZScgJiYgcGF1c2UgIT09ICdyZXN1bWUnICYmIHBhdXNlICE9PSBudWxsKSB7XG4gICAgICAgICAgICAgICAgdGhpcy5fZGVidWcoJ0ludmFsaWQgYXJndW1lbnQuIFRvZ2dsaW5nIHBhdXNlIHZhbHVlIGluc3RlYWQnKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgcGF1c2UgPSAocGF1c2UgJiYgKHBhdXNlID09PSAncGF1c2UnIHx8IHBhdXNlID09PSAncmVzdW1lJykpID8gcGF1c2UgOiAndG9nZ2xlJztcblxuICAgICAgICAgICAgc3dpdGNoIChwYXVzZSkge1xuICAgICAgICAgICAgICAgIGNhc2UgJ3BhdXNlJzpcbiAgICAgICAgICAgICAgICAgICAgb3B0cy5zdGF0ZS5pc1BhdXNlZCA9IHRydWU7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG5cbiAgICAgICAgICAgICAgICBjYXNlICdyZXN1bWUnOlxuICAgICAgICAgICAgICAgICAgICBvcHRzLnN0YXRlLmlzUGF1c2VkID0gZmFsc2U7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG5cbiAgICAgICAgICAgICAgICBjYXNlICd0b2dnbGUnOlxuICAgICAgICAgICAgICAgICAgICBvcHRzLnN0YXRlLmlzUGF1c2VkID0gIW9wdHMuc3RhdGUuaXNQYXVzZWQ7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHRoaXMuX2RlYnVnKCdQYXVzZWQnLCBvcHRzLnN0YXRlLmlzUGF1c2VkKTtcbiAgICAgICAgICAgIHJldHVybiBmYWxzZTtcblxuICAgICAgICB9LFxuXG4gICAgICAgIC8vIEJlaGF2aW9yIGlzIGRldGVybWluZWRcbiAgICAgICAgLy8gSWYgdGhlIGJlaGF2aW9yIG9wdGlvbiBpcyB1bmRlZmluZWQsIGl0IHdpbGwgc2V0IHRvIGRlZmF1bHQgYW5kIGJpbmQgdG8gc2Nyb2xsXG4gICAgICAgIF9zZXR1cDogZnVuY3Rpb24gaW5mc2NyX3NldHVwKCkge1xuXG4gICAgICAgICAgICB2YXIgb3B0cyA9IHRoaXMub3B0aW9ucztcblxuICAgICAgICAgICAgLy8gaWYgYmVoYXZpb3IgaXMgZGVmaW5lZCBhbmQgdGhpcyBmdW5jdGlvbiBpcyBleHRlbmRlZCwgY2FsbCB0aGF0IGluc3RlYWQgb2YgZGVmYXVsdFxuICAgICAgICAgICAgaWYgKCEhb3B0cy5iZWhhdmlvciAmJiB0aGlzWydfc2V0dXBfJytvcHRzLmJlaGF2aW9yXSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgICAgICAgICAgdGhpc1snX3NldHVwXycrb3B0cy5iZWhhdmlvcl0uY2FsbCh0aGlzKTtcbiAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHRoaXMuX2JpbmRpbmcoJ2JpbmQnKTtcblxuICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuXG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gU2hvdyBkb25lIG1lc3NhZ2VcbiAgICAgICAgX3Nob3dkb25lbXNnOiBmdW5jdGlvbiBpbmZzY3Jfc2hvd2RvbmVtc2coKSB7XG5cbiAgICAgICAgICAgIHZhciBvcHRzID0gdGhpcy5vcHRpb25zO1xuXG4gICAgICAgICAgICAvLyBpZiBiZWhhdmlvciBpcyBkZWZpbmVkIGFuZCB0aGlzIGZ1bmN0aW9uIGlzIGV4dGVuZGVkLCBjYWxsIHRoYXQgaW5zdGVhZCBvZiBkZWZhdWx0XG4gICAgICAgICAgICBpZiAoISFvcHRzLmJlaGF2aW9yICYmIHRoaXNbJ19zaG93ZG9uZW1zZ18nK29wdHMuYmVoYXZpb3JdICE9PSB1bmRlZmluZWQpIHtcbiAgICAgICAgICAgICAgICB0aGlzWydfc2hvd2RvbmVtc2dfJytvcHRzLmJlaGF2aW9yXS5jYWxsKHRoaXMpO1xuICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgb3B0cy5sb2FkaW5nLm1zZ1xuICAgICAgICAgICAgLmZpbmQoJ2ltZycpXG4gICAgICAgICAgICAuaGlkZSgpXG4gICAgICAgICAgICAucGFyZW50KClcbiAgICAgICAgICAgIC5maW5kKCdkaXYnKS5odG1sKG9wdHMubG9hZGluZy5maW5pc2hlZE1zZykuYW5pbWF0ZSh7IG9wYWNpdHk6IDEgfSwgMjAwMCwgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkuZmFkZU91dChvcHRzLmxvYWRpbmcuc3BlZWQpO1xuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIC8vIHVzZXIgcHJvdmlkZWQgY2FsbGJhY2sgd2hlbiBkb25lICAgIFxuICAgICAgICAgICAgb3B0cy5lcnJvckNhbGxiYWNrLmNhbGwoJChvcHRzLmNvbnRlbnRTZWxlY3RvcilbMF0sJ2RvbmUnKTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyBncmFiIGVhY2ggc2VsZWN0b3Igb3B0aW9uIGFuZCBzZWUgaWYgYW55IGZhaWxcbiAgICAgICAgX3ZhbGlkYXRlOiBmdW5jdGlvbiBpbmZzY3JfdmFsaWRhdGUob3B0cykge1xuICAgICAgICAgICAgZm9yICh2YXIga2V5IGluIG9wdHMpIHtcbiAgICAgICAgICAgICAgICBpZiAoa2V5LmluZGV4T2YgJiYga2V5LmluZGV4T2YoJ1NlbGVjdG9yJykgPiAtMSAmJiAkKG9wdHNba2V5XSkubGVuZ3RoID09PSAwKSB7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMuX2RlYnVnKCdZb3VyICcgKyBrZXkgKyAnIGZvdW5kIG5vIGVsZW1lbnRzLicpO1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICByZXR1cm4gdHJ1ZTtcbiAgICAgICAgfSxcblxuICAgICAgICAvKlx0XG4gICAgICAgICAgICAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gICAgICAgICAgICBQdWJsaWMgbWV0aG9kc1xuICAgICAgICAgICAgLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICAgICAgICAgICAgKi9cblxuICAgICAgICAvLyBCaW5kIHRvIHNjcm9sbFxuICAgICAgICBiaW5kOiBmdW5jdGlvbiBpbmZzY3JfYmluZCgpIHtcbiAgICAgICAgICAgIHRoaXMuX2JpbmRpbmcoJ2JpbmQnKTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyBEZXN0cm95IGN1cnJlbnQgaW5zdGFuY2Ugb2YgcGx1Z2luXG4gICAgICAgIGRlc3Ryb3k6IGZ1bmN0aW9uIGluZnNjcl9kZXN0cm95KCkge1xuICAgICAgICAgICAgdGhpcy5vcHRpb25zLnN0YXRlLmlzRGVzdHJveWVkID0gdHJ1ZTtcblx0XHRcdHRoaXMub3B0aW9ucy5sb2FkaW5nLmZpbmlzaGVkKCk7XG4gICAgICAgICAgICByZXR1cm4gdGhpcy5fZXJyb3IoJ2Rlc3Ryb3knKTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyBTZXQgcGF1c2UgdmFsdWUgdG8gZmFsc2VcbiAgICAgICAgcGF1c2U6IGZ1bmN0aW9uIGluZnNjcl9wYXVzZSgpIHtcbiAgICAgICAgICAgIHRoaXMuX3BhdXNpbmcoJ3BhdXNlJyk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gU2V0IHBhdXNlIHZhbHVlIHRvIGZhbHNlXG4gICAgICAgIHJlc3VtZTogZnVuY3Rpb24gaW5mc2NyX3Jlc3VtZSgpIHtcbiAgICAgICAgICAgIHRoaXMuX3BhdXNpbmcoJ3Jlc3VtZScpO1xuICAgICAgICB9LFxuXG5cdFx0YmVnaW5BamF4OiBmdW5jdGlvbiBpbmZzY3JfYWpheChvcHRzKSB7XG5cdFx0XHR2YXIgaW5zdGFuY2UgPSB0aGlzLFxuXHRcdFx0XHRwYXRoID0gb3B0cy5wYXRoLFxuXHRcdFx0XHRib3gsIGRlc3R1cmwsIG1ldGhvZCwgY29uZGl0aW9uO1xuXG5cdFx0XHQvLyBpbmNyZW1lbnQgdGhlIFVSTCBiaXQuIGUuZy4gL3BhZ2UvMy9cblx0XHRcdG9wdHMuc3RhdGUuY3VyclBhZ2UrKztcblxuICAgICAgICAgICAgLy8gTWFudWFsbHkgY29udHJvbCBtYXhpbXVtIHBhZ2UgXG4gICAgICAgICAgICBpZiAoIG9wdHMubWF4UGFnZSAhPSB1bmRlZmluZWQgJiYgb3B0cy5zdGF0ZS5jdXJyUGFnZSA+IG9wdHMubWF4UGFnZSApe1xuICAgICAgICAgICAgICAgIG9wdHMuc3RhdGUuaXNCZXlvbmRNYXhQYWdlID0gdHJ1ZTtcbiAgICAgICAgICAgICAgICB0aGlzLmRlc3Ryb3koKTtcbiAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICB9XG5cblx0XHRcdC8vIGlmIHdlJ3JlIGRlYWxpbmcgd2l0aCBhIHRhYmxlIHdlIGNhbid0IHVzZSBESVZzXG5cdFx0XHRib3ggPSAkKG9wdHMuY29udGVudFNlbGVjdG9yKS5pcygndGFibGUsIHRib2R5JykgPyAkKCc8dGJvZHkvPicpIDogJCgnPGRpdi8+Jyk7XG5cblx0XHRcdGRlc3R1cmwgPSAodHlwZW9mIHBhdGggPT09ICdmdW5jdGlvbicpID8gcGF0aChvcHRzLnN0YXRlLmN1cnJQYWdlKSA6IHBhdGguam9pbihvcHRzLnN0YXRlLmN1cnJQYWdlKTtcblx0XHRcdGluc3RhbmNlLl9kZWJ1ZygnaGVhZGluZyBpbnRvIGFqYXgnLCBkZXN0dXJsKTtcblxuXHRcdFx0bWV0aG9kID0gKG9wdHMuZGF0YVR5cGUgPT09ICdodG1sJyB8fCBvcHRzLmRhdGFUeXBlID09PSAnanNvbicgKSA/IG9wdHMuZGF0YVR5cGUgOiAnaHRtbCtjYWxsYmFjayc7XG5cdFx0XHRpZiAob3B0cy5hcHBlbmRDYWxsYmFjayAmJiBvcHRzLmRhdGFUeXBlID09PSAnaHRtbCcpIHtcblx0XHRcdFx0bWV0aG9kICs9ICcrY2FsbGJhY2snO1xuXHRcdFx0fVxuXG5cdFx0XHRzd2l0Y2ggKG1ldGhvZCkge1xuXHRcdFx0XHRjYXNlICdodG1sK2NhbGxiYWNrJzpcblx0XHRcdFx0XHRpbnN0YW5jZS5fZGVidWcoJ1VzaW5nIEhUTUwgdmlhIC5sb2FkKCkgbWV0aG9kJyk7XG5cdFx0XHRcdFx0Ym94LmxvYWQoZGVzdHVybCArICcgJyArIG9wdHMuaXRlbVNlbGVjdG9yLCB1bmRlZmluZWQsIGZ1bmN0aW9uIGluZnNjcl9hamF4X2NhbGxiYWNrKHJlc3BvbnNlVGV4dCkge1xuXHRcdFx0XHRcdFx0aW5zdGFuY2UuX2xvYWRjYWxsYmFjayhib3gsIHJlc3BvbnNlVGV4dCwgZGVzdHVybCk7XG5cdFx0XHRcdFx0fSk7XG5cblx0XHRcdFx0XHRicmVhaztcblxuXHRcdFx0XHRjYXNlICdodG1sJzpcblx0XHRcdFx0XHRpbnN0YW5jZS5fZGVidWcoJ1VzaW5nICcgKyAobWV0aG9kLnRvVXBwZXJDYXNlKCkpICsgJyB2aWEgJC5hamF4KCkgbWV0aG9kJyk7XG5cdFx0XHRcdFx0JC5hamF4KHtcblx0XHRcdFx0XHRcdC8vIHBhcmFtc1xuXHRcdFx0XHRcdFx0dXJsOiBkZXN0dXJsLFxuXHRcdFx0XHRcdFx0ZGF0YVR5cGU6IG9wdHMuZGF0YVR5cGUsXG5cdFx0XHRcdFx0XHRjb21wbGV0ZTogZnVuY3Rpb24gaW5mc2NyX2FqYXhfY2FsbGJhY2soanFYSFIsIHRleHRTdGF0dXMpIHtcblx0XHRcdFx0XHRcdFx0Y29uZGl0aW9uID0gKHR5cGVvZiAoanFYSFIuaXNSZXNvbHZlZCkgIT09ICd1bmRlZmluZWQnKSA/IChqcVhIUi5pc1Jlc29sdmVkKCkpIDogKHRleHRTdGF0dXMgPT09IFwic3VjY2Vzc1wiIHx8IHRleHRTdGF0dXMgPT09IFwibm90bW9kaWZpZWRcIik7XG5cdFx0XHRcdFx0XHRcdGlmIChjb25kaXRpb24pIHtcblx0XHRcdFx0XHRcdFx0XHRpbnN0YW5jZS5fbG9hZGNhbGxiYWNrKGJveCwganFYSFIucmVzcG9uc2VUZXh0LCBkZXN0dXJsKTtcblx0XHRcdFx0XHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0XHRcdFx0XHRpbnN0YW5jZS5fZXJyb3IoJ2VuZCcpO1xuXHRcdFx0XHRcdFx0XHR9XG5cdFx0XHRcdFx0XHR9XG5cdFx0XHRcdFx0fSk7XG5cblx0XHRcdFx0XHRicmVhaztcblx0XHRcdFx0Y2FzZSAnanNvbic6XG5cdFx0XHRcdFx0aW5zdGFuY2UuX2RlYnVnKCdVc2luZyAnICsgKG1ldGhvZC50b1VwcGVyQ2FzZSgpKSArICcgdmlhICQuYWpheCgpIG1ldGhvZCcpO1xuXHRcdFx0XHRcdCQuYWpheCh7XG5cdFx0XHRcdFx0XHRkYXRhVHlwZTogJ2pzb24nLFxuXHRcdFx0XHRcdFx0dHlwZTogJ0dFVCcsXG5cdFx0XHRcdFx0XHR1cmw6IGRlc3R1cmwsXG5cdFx0XHRcdFx0XHRzdWNjZXNzOiBmdW5jdGlvbiAoZGF0YSwgdGV4dFN0YXR1cywganFYSFIpIHtcblx0XHRcdFx0XHRcdFx0Y29uZGl0aW9uID0gKHR5cGVvZiAoanFYSFIuaXNSZXNvbHZlZCkgIT09ICd1bmRlZmluZWQnKSA/IChqcVhIUi5pc1Jlc29sdmVkKCkpIDogKHRleHRTdGF0dXMgPT09IFwic3VjY2Vzc1wiIHx8IHRleHRTdGF0dXMgPT09IFwibm90bW9kaWZpZWRcIik7XG5cdFx0XHRcdFx0XHRcdGlmIChvcHRzLmFwcGVuZENhbGxiYWNrKSB7XG5cdFx0XHRcdFx0XHRcdFx0Ly8gaWYgYXBwZW5kQ2FsbGJhY2sgaXMgdHJ1ZSwgeW91IG11c3QgZGVmaW5lZCB0ZW1wbGF0ZSBpbiBvcHRpb25zLlxuXHRcdFx0XHRcdFx0XHRcdC8vIG5vdGUgdGhhdCBkYXRhIHBhc3NlZCBpbnRvIF9sb2FkY2FsbGJhY2sgaXMgYWxyZWFkeSBhbiBodG1sIChhZnRlciBwcm9jZXNzZWQgaW4gb3B0cy50ZW1wbGF0ZShkYXRhKSkuXG5cdFx0XHRcdFx0XHRcdFx0aWYgKG9wdHMudGVtcGxhdGUgIT09IHVuZGVmaW5lZCkge1xuXHRcdFx0XHRcdFx0XHRcdFx0dmFyIHRoZURhdGEgPSBvcHRzLnRlbXBsYXRlKGRhdGEpO1xuXHRcdFx0XHRcdFx0XHRcdFx0Ym94LmFwcGVuZCh0aGVEYXRhKTtcblx0XHRcdFx0XHRcdFx0XHRcdGlmIChjb25kaXRpb24pIHtcblx0XHRcdFx0XHRcdFx0XHRcdFx0aW5zdGFuY2UuX2xvYWRjYWxsYmFjayhib3gsIHRoZURhdGEpO1xuXHRcdFx0XHRcdFx0XHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0XHRcdFx0XHRcdFx0aW5zdGFuY2UuX2Vycm9yKCdlbmQnKTtcblx0XHRcdFx0XHRcdFx0XHRcdH1cblx0XHRcdFx0XHRcdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHRcdFx0XHRcdFx0aW5zdGFuY2UuX2RlYnVnKFwidGVtcGxhdGUgbXVzdCBiZSBkZWZpbmVkLlwiKTtcblx0XHRcdFx0XHRcdFx0XHRcdGluc3RhbmNlLl9lcnJvcignZW5kJyk7XG5cdFx0XHRcdFx0XHRcdFx0fVxuXHRcdFx0XHRcdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHRcdFx0XHRcdC8vIGlmIGFwcGVuZENhbGxiYWNrIGlzIGZhbHNlLCB3ZSB3aWxsIHBhc3MgaW4gdGhlIEpTT04gb2JqZWN0LiB5b3Ugc2hvdWxkIGhhbmRsZSBpdCB5b3Vyc2VsZiBpbiB5b3VyIGNhbGxiYWNrLlxuXHRcdFx0XHRcdFx0XHRcdGlmIChjb25kaXRpb24pIHtcblx0XHRcdFx0XHRcdFx0XHRcdGluc3RhbmNlLl9sb2FkY2FsbGJhY2soYm94LCBkYXRhLCBkZXN0dXJsKTtcblx0XHRcdFx0XHRcdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHRcdFx0XHRcdFx0aW5zdGFuY2UuX2Vycm9yKCdlbmQnKTtcblx0XHRcdFx0XHRcdFx0XHR9XG5cdFx0XHRcdFx0XHRcdH1cblx0XHRcdFx0XHRcdH0sXG5cdFx0XHRcdFx0XHRlcnJvcjogZnVuY3Rpb24oKSB7XG5cdFx0XHRcdFx0XHRcdGluc3RhbmNlLl9kZWJ1ZyhcIkpTT04gYWpheCByZXF1ZXN0IGZhaWxlZC5cIik7XG5cdFx0XHRcdFx0XHRcdGluc3RhbmNlLl9lcnJvcignZW5kJyk7XG5cdFx0XHRcdFx0XHR9XG5cdFx0XHRcdFx0fSk7XG5cblx0XHRcdFx0XHRicmVhaztcblx0XHRcdH1cblx0XHR9LFxuXG4gICAgICAgIC8vIFJldHJpZXZlIG5leHQgc2V0IG9mIGNvbnRlbnQgaXRlbXNcbiAgICAgICAgcmV0cmlldmU6IGZ1bmN0aW9uIGluZnNjcl9yZXRyaWV2ZShwYWdlTnVtKSB7XG5cdFx0XHRwYWdlTnVtID0gcGFnZU51bSB8fCBudWxsO1xuXG5cdFx0XHR2YXIgaW5zdGFuY2UgPSB0aGlzLFxuICAgICAgICAgICAgb3B0cyA9IGluc3RhbmNlLm9wdGlvbnM7XG5cbiAgICAgICAgICAgIC8vIGlmIGJlaGF2aW9yIGlzIGRlZmluZWQgYW5kIHRoaXMgZnVuY3Rpb24gaXMgZXh0ZW5kZWQsIGNhbGwgdGhhdCBpbnN0ZWFkIG9mIGRlZmF1bHRcbiAgICAgICAgICAgIGlmICghIW9wdHMuYmVoYXZpb3IgJiYgdGhpc1sncmV0cmlldmVfJytvcHRzLmJlaGF2aW9yXSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgICAgICAgICAgdGhpc1sncmV0cmlldmVfJytvcHRzLmJlaGF2aW9yXS5jYWxsKHRoaXMscGFnZU51bSk7XG4gICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAvLyBmb3IgbWFudWFsIHRyaWdnZXJzLCBpZiBkZXN0cm95ZWQsIGdldCBvdXQgb2YgaGVyZVxuICAgICAgICAgICAgaWYgKG9wdHMuc3RhdGUuaXNEZXN0cm95ZWQpIHtcbiAgICAgICAgICAgICAgICB0aGlzLl9kZWJ1ZygnSW5zdGFuY2UgaXMgZGVzdHJveWVkJyk7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAvLyB3ZSBkb250IHdhbnQgdG8gZmlyZSB0aGUgYWpheCBtdWx0aXBsZSB0aW1lc1xuICAgICAgICAgICAgb3B0cy5zdGF0ZS5pc0R1cmluZ0FqYXggPSB0cnVlO1xuXG4gICAgICAgICAgICBvcHRzLmxvYWRpbmcuc3RhcnQuY2FsbCgkKG9wdHMuY29udGVudFNlbGVjdG9yKVswXSxvcHRzKTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyBDaGVjayB0byBzZWUgbmV4dCBwYWdlIGlzIG5lZWRlZFxuICAgICAgICBzY3JvbGw6IGZ1bmN0aW9uIGluZnNjcl9zY3JvbGwoKSB7XG5cbiAgICAgICAgICAgIHZhciBvcHRzID0gdGhpcy5vcHRpb25zLFxuICAgICAgICAgICAgc3RhdGUgPSBvcHRzLnN0YXRlO1xuXG4gICAgICAgICAgICAvLyBpZiBiZWhhdmlvciBpcyBkZWZpbmVkIGFuZCB0aGlzIGZ1bmN0aW9uIGlzIGV4dGVuZGVkLCBjYWxsIHRoYXQgaW5zdGVhZCBvZiBkZWZhdWx0XG4gICAgICAgICAgICBpZiAoISFvcHRzLmJlaGF2aW9yICYmIHRoaXNbJ3Njcm9sbF8nK29wdHMuYmVoYXZpb3JdICE9PSB1bmRlZmluZWQpIHtcbiAgICAgICAgICAgICAgICB0aGlzWydzY3JvbGxfJytvcHRzLmJlaGF2aW9yXS5jYWxsKHRoaXMpO1xuICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKHN0YXRlLmlzRHVyaW5nQWpheCB8fCBzdGF0ZS5pc0ludmFsaWRQYWdlIHx8IHN0YXRlLmlzRG9uZSB8fCBzdGF0ZS5pc0Rlc3Ryb3llZCB8fCBzdGF0ZS5pc1BhdXNlZCkge1xuXHRcdFx0XHRyZXR1cm47XG5cdFx0XHR9XG5cbiAgICAgICAgICAgIGlmICghdGhpcy5fbmVhcmJvdHRvbSgpKSB7XG5cdFx0XHRcdHJldHVybjtcblx0XHRcdH1cblxuICAgICAgICAgICAgdGhpcy5yZXRyaWV2ZSgpO1xuXG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gVG9nZ2xlIHBhdXNlIHZhbHVlXG4gICAgICAgIHRvZ2dsZTogZnVuY3Rpb24gaW5mc2NyX3RvZ2dsZSgpIHtcbiAgICAgICAgICAgIHRoaXMuX3BhdXNpbmcoKTtcbiAgICAgICAgfSxcblxuICAgICAgICAvLyBVbmJpbmQgZnJvbSBzY3JvbGxcbiAgICAgICAgdW5iaW5kOiBmdW5jdGlvbiBpbmZzY3JfdW5iaW5kKCkge1xuICAgICAgICAgICAgdGhpcy5fYmluZGluZygndW5iaW5kJyk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgLy8gdXBkYXRlIG9wdGlvbnNcbiAgICAgICAgdXBkYXRlOiBmdW5jdGlvbiBpbmZzY3Jfb3B0aW9ucyhrZXkpIHtcbiAgICAgICAgICAgIGlmICgkLmlzUGxhaW5PYmplY3Qoa2V5KSkge1xuICAgICAgICAgICAgICAgIHRoaXMub3B0aW9ucyA9ICQuZXh0ZW5kKHRydWUsdGhpcy5vcHRpb25zLGtleSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9O1xuXG5cbiAgICAvKlx0XG4gICAgICAgIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgICAgICAgSW5maW5pdGUgU2Nyb2xsIGZ1bmN0aW9uXG4gICAgICAgIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cblxuICAgICAgICBCb3Jyb3dlZCBsb2dpYyBmcm9tIHRoZSBmb2xsb3dpbmcuLi5cblxuICAgICAgICBqUXVlcnkgVUlcbiAgICAgICAgLSBodHRwczovL2dpdGh1Yi5jb20vanF1ZXJ5L2pxdWVyeS11aS9ibG9iL21hc3Rlci91aS9qcXVlcnkudWkud2lkZ2V0LmpzXG5cbiAgICAgICAgakNhcm91c2VsXG4gICAgICAgIC0gaHR0cHM6Ly9naXRodWIuY29tL2pzb3IvamNhcm91c2VsL2Jsb2IvbWFzdGVyL2xpYi9qcXVlcnkuamNhcm91c2VsLmpzXG5cbiAgICAgICAgTWFzb25yeVxuICAgICAgICAtIGh0dHBzOi8vZ2l0aHViLmNvbS9kZXNhbmRyby9tYXNvbnJ5L2Jsb2IvbWFzdGVyL2pxdWVyeS5tYXNvbnJ5LmpzXHRcdFxuXG4qL1xuXG4gICAgJC5mbi5pbmZpbml0ZXNjcm9sbCA9IGZ1bmN0aW9uIGluZnNjcl9pbml0KG9wdGlvbnMsIGNhbGxiYWNrKSB7XG5cblxuICAgICAgICB2YXIgdGhpc0NhbGwgPSB0eXBlb2Ygb3B0aW9ucztcblxuICAgICAgICBzd2l0Y2ggKHRoaXNDYWxsKSB7XG5cbiAgICAgICAgICAgIC8vIG1ldGhvZCBcbiAgICAgICAgICAgIGNhc2UgJ3N0cmluZyc6XG4gICAgICAgICAgICAgICAgdmFyIGFyZ3MgPSBBcnJheS5wcm90b3R5cGUuc2xpY2UuY2FsbChhcmd1bWVudHMsIDEpO1xuXG5cdFx0XHRcdHRoaXMuZWFjaChmdW5jdGlvbiAoKSB7XG5cdFx0XHRcdFx0dmFyIGluc3RhbmNlID0gJC5kYXRhKHRoaXMsICdpbmZpbml0ZXNjcm9sbCcpO1xuXG5cdFx0XHRcdFx0aWYgKCFpbnN0YW5jZSkge1xuXHRcdFx0XHRcdFx0Ly8gbm90IHNldHVwIHlldFxuXHRcdFx0XHRcdFx0Ly8gcmV0dXJuICQuZXJyb3IoJ01ldGhvZCAnICsgb3B0aW9ucyArICcgY2Fubm90IGJlIGNhbGxlZCB1bnRpbCBJbmZpbml0ZSBTY3JvbGwgaXMgc2V0dXAnKTtcblx0XHRcdFx0XHRcdHJldHVybiBmYWxzZTtcblx0XHRcdFx0XHR9XG5cblx0XHRcdFx0XHRpZiAoISQuaXNGdW5jdGlvbihpbnN0YW5jZVtvcHRpb25zXSkgfHwgb3B0aW9ucy5jaGFyQXQoMCkgPT09IFwiX1wiKSB7XG5cdFx0XHRcdFx0XHQvLyByZXR1cm4gJC5lcnJvcignTm8gc3VjaCBtZXRob2QgJyArIG9wdGlvbnMgKyAnIGZvciBJbmZpbml0ZSBTY3JvbGwnKTtcblx0XHRcdFx0XHRcdHJldHVybiBmYWxzZTtcblx0XHRcdFx0XHR9XG5cblx0XHRcdFx0XHQvLyBubyBlcnJvcnMhXG5cdFx0XHRcdFx0aW5zdGFuY2Vbb3B0aW9uc10uYXBwbHkoaW5zdGFuY2UsIGFyZ3MpO1xuXHRcdFx0XHR9KTtcblxuICAgICAgICAgICAgYnJlYWs7XG5cbiAgICAgICAgICAgIC8vIGNyZWF0aW9uIFxuICAgICAgICAgICAgY2FzZSAnb2JqZWN0JzpcblxuICAgICAgICAgICAgICAgIHRoaXMuZWFjaChmdW5jdGlvbiAoKSB7XG5cbiAgICAgICAgICAgICAgICB2YXIgaW5zdGFuY2UgPSAkLmRhdGEodGhpcywgJ2luZmluaXRlc2Nyb2xsJyk7XG5cbiAgICAgICAgICAgICAgICBpZiAoaW5zdGFuY2UpIHtcblxuICAgICAgICAgICAgICAgICAgICAvLyB1cGRhdGUgb3B0aW9ucyBvZiBjdXJyZW50IGluc3RhbmNlXG4gICAgICAgICAgICAgICAgICAgIGluc3RhbmNlLnVwZGF0ZShvcHRpb25zKTtcblxuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG5cbiAgICAgICAgICAgICAgICAgICAgLy8gaW5pdGlhbGl6ZSBuZXcgaW5zdGFuY2VcbiAgICAgICAgICAgICAgICAgICAgaW5zdGFuY2UgPSBuZXcgJC5pbmZpbml0ZXNjcm9sbChvcHRpb25zLCBjYWxsYmFjaywgdGhpcyk7XG5cbiAgICAgICAgICAgICAgICAgICAgLy8gZG9uJ3QgYXR0YWNoIGlmIGluc3RhbnRpYXRpb24gZmFpbGVkXG4gICAgICAgICAgICAgICAgICAgIGlmICghaW5zdGFuY2UuZmFpbGVkKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAkLmRhdGEodGhpcywgJ2luZmluaXRlc2Nyb2xsJywgaW5zdGFuY2UpO1xuICAgICAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICBicmVhaztcblxuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHRoaXM7XG4gICAgfTtcblxuXG5cbiAgICAvKiBcbiAgICAgKiBzbWFydHNjcm9sbDogZGVib3VuY2VkIHNjcm9sbCBldmVudCBmb3IgalF1ZXJ5ICpcbiAgICAgKiBodHRwczovL2dpdGh1Yi5jb20vbHVrZXNodW1hcmQvc21hcnRzY3JvbGxcbiAgICAgKiBCYXNlZCBvbiBzbWFydHJlc2l6ZSBieSBAbG91aXNfcmVtaTogaHR0cHM6Ly9naXRodWIuY29tL2xyYmFiZS9qcXVlcnkuc21hcnRyZXNpemUuanMgKlxuICAgICAqIENvcHlyaWdodCAyMDExIExvdWlzLVJlbWkgJiBMdWtlIFNodW1hcmQgKiBMaWNlbnNlZCB1bmRlciB0aGUgTUlUIGxpY2Vuc2UuICpcbiAgICAgKi9cblxuICAgIHZhciBldmVudCA9ICQuZXZlbnQsXG4gICAgc2Nyb2xsVGltZW91dDtcblxuICAgIGV2ZW50LnNwZWNpYWwuc21hcnRzY3JvbGwgPSB7XG4gICAgICAgIHNldHVwOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkKHRoaXMpLmJpbmQoXCJzY3JvbGxcIiwgZXZlbnQuc3BlY2lhbC5zbWFydHNjcm9sbC5oYW5kbGVyKTtcbiAgICAgICAgfSxcbiAgICAgICAgdGVhcmRvd246IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICQodGhpcykudW5iaW5kKFwic2Nyb2xsXCIsIGV2ZW50LnNwZWNpYWwuc21hcnRzY3JvbGwuaGFuZGxlcik7XG4gICAgICAgIH0sXG4gICAgICAgIGhhbmRsZXI6IGZ1bmN0aW9uIChldmVudCwgZXhlY0FzYXApIHtcbiAgICAgICAgICAgIC8vIFNhdmUgdGhlIGNvbnRleHRcbiAgICAgICAgICAgIHZhciBjb250ZXh0ID0gdGhpcyxcbiAgICAgICAgICAgIGFyZ3MgPSBhcmd1bWVudHM7XG5cbiAgICAgICAgICAgIC8vIHNldCBjb3JyZWN0IGV2ZW50IHR5cGVcbiAgICAgICAgICAgIGV2ZW50LnR5cGUgPSBcInNtYXJ0c2Nyb2xsXCI7XG5cbiAgICAgICAgICAgIGlmIChzY3JvbGxUaW1lb3V0KSB7IGNsZWFyVGltZW91dChzY3JvbGxUaW1lb3V0KTsgfVxuICAgICAgICAgICAgc2Nyb2xsVGltZW91dCA9IHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICQoY29udGV4dCkudHJpZ2dlcignc21hcnRzY3JvbGwnLCBhcmdzKTtcbiAgICAgICAgICAgIH0sIGV4ZWNBc2FwID09PSBcImV4ZWNBc2FwXCIgPyAwIDogMTAwKTtcbiAgICAgICAgfVxuICAgIH07XG5cbiAgICAkLmZuLnNtYXJ0c2Nyb2xsID0gZnVuY3Rpb24gKGZuKSB7XG4gICAgICAgIHJldHVybiBmbiA/IHRoaXMuYmluZChcInNtYXJ0c2Nyb2xsXCIsIGZuKSA6IHRoaXMudHJpZ2dlcihcInNtYXJ0c2Nyb2xsXCIsIFtcImV4ZWNBc2FwXCJdKTtcbiAgICB9O1xuXG5cbn0pKHdpbmRvdywgalF1ZXJ5KTtcbiJdLCJmaWxlIjoianF1ZXJ5LmluZmluaXRlc2Nyb2xsLmpzIn0=
