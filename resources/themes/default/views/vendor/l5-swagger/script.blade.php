<?php

/* 
 * The MIT License
 *
 * Copyright 2017 Sotiris Karampatakis Open Knowledge Greece.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
    <script type="text/javascript">
        $(function () {
            var url = window.location.search.match(/url=([^&]+)/);
            if (url && url.length > 1) {
                url = decodeURIComponent(url[1]);
            } else {
                url = "{!! $urlToDocs !!}";
            }

            hljs.configure({
                highlightSizeThreshold: {{ $highlightThreshold }}
            });

            // Pre load translate...
            if(window.SwaggerTranslator) {
                window.SwaggerTranslator.translate();
            }
            window.swaggerUi = new SwaggerUi({
                url: url,
                dom_id: "swagger-ui-container",
                @if(array_key_exists('validatorUrl', get_defined_vars()))
                // This differentiates between a null value and an undefined variable
                validatorUrl: {!! isset($validatorUrl) ? '"' . $validatorUrl . '"' : 'null' !!},
                @endif
                supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
                onComplete: function(swaggerApi, swaggerUi){
                    @if(isset($requestHeaders))
                    @foreach($requestHeaders as $requestKey => $requestValue)
                    window.swaggerUi.api.clientAuthorizations.add("{{$requestKey}}", new SwaggerClient.ApiKeyAuthorization("{{$requestKey}}", "{{$requestValue}}", "header"));
                    @endforeach
                            @endif

                    if(typeof initOAuth == "function") {
                        initOAuth({
                            clientId: "your-client-id",
                            clientSecret: "your-client-secret-if-required",
                            realm: "your-realms",
                            appName: "your-app-name",
                            scopeSeparator: ",",
                            additionalQueryStringParams: {}
                        });
                    }

                    if(window.SwaggerTranslator) {
                        window.SwaggerTranslator.translate();
                    }
                },

                onFailure: function(data) {
                    console.log("Unable to Load SwaggerUI");
                },
                docExpansion: {!! isset($docExpansion) ? '"' . $docExpansion . '"' : '"none"' !!},
                jsonEditor: false,
                apisSorter: "alpha",
                defaultModelRendering: 'schema',
                showRequestHeaders: false
            });

            function addApiKeyAuthorization(){
                var key = $('#input_apiKey')[0].value;

                if ("{{$apiKeyInject}}" === "query") {
                    key = encodeURIComponent(key);
                }

                if(key && key.trim() != "") {
                    var apiKeyAuth = new SwaggerClient.ApiKeyAuthorization("{{$apiKeyVar}}", key, "{{$apiKeyInject}}");
                    window.swaggerUi.api.clientAuthorizations.add("{{$securityDefinition}}", apiKeyAuth);
                }
            }

            $('#input_apiKey').change(function() {
                addApiKeyAuthorization();
            });

            window.swaggerUi.load();

            // if you have an apiKey you would like to pre-populate on the page for demonstration purposes
            // just put it in the .env file, API_AUTH_TOKEN variable
            @if($apiKey)
            $('#input_apiKey').val("{{$apiKey}}");
            addApiKeyAuthorization();
            @endif
        });
    </script>
