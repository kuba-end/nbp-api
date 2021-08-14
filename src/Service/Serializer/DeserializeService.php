<?php
//
//namespace App\Service\Serializer;
//
//use Symfony\Component\Serializer\Encoder\JsonEncoder;
//use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
//use Symfony\Component\Serializer\Serializer;
//
//class DeserializeJsonService
//{
//
//    public function __construct()
//    {
//        $encoder = [new JsonEncoder()];
//        $normalizers = [new ObjectNormalizer()];
//
//        $serializer = new Serializer($normalizers,$encoder);
//
//        $currencies = $serializer->deserialize()
//    }
//}